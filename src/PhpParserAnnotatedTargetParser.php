<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use FilesystemIterator;
use Generator;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;
use ReflectionProperty;

final class PhpParserAnnotatedTargetParser implements AnnotatedTargetParser {

    private readonly Parser $parser;

    public function __construct() {
        $this->parser = (new ParserFactory())->create(ParserFactory::ONLY_PHP7);
    }

    public function parse(AnnotatedTargetParserOptions $options) : Generator {
        $nodeTraverser = new NodeTraverser();
        $nodeTraverser->addVisitor(new NodeVisitor\NodeConnectingVisitor());
        $nodeTraverser->addVisitor(new NodeVisitor\NameResolver());
        $data = new \stdClass();
        $data->targets = [];
        $nodeTraverser->addVisitor($this->getVisitor(fn($target) => $data->targets[] = $target));

        foreach ($this->getSourceIterator($options) as $sourceFile) {
            $nodes = $this->parser->parse(file_get_contents($sourceFile->getPathname()));
            $nodeTraverser->traverse($nodes);
            unset($nodes);
        }

        yield from $data->targets;
    }

    private function getSourceIterator(AnnotatedTargetParserOptions $options) : \Iterator {
        foreach ($options->getSourceDirectories() as $directory) {
            yield from new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS)
            );
        }
    }

    private function getVisitor(callable $consumer) : NodeVisitor {
        return new class($consumer) extends NodeVisitorAbstract {

            private $consumer;

            public function __construct(callable $consumer) {
                $this->consumer = $consumer;
            }

            public function leaveNode(Node $node) {
                if ($node instanceof Node\Stmt\Class_ || $node instanceof Node\Stmt\Property ||
                    $node instanceof Node\Stmt\ClassConst || $node instanceof Node\Stmt\ClassMethod ||
                    $node instanceof Node\Param || $node instanceof Node\Stmt\Function_) {
                    /** @var Node\AttributeGroup $attr */
                    $index = 0;
                    foreach ($node->attrGroups as $attrGroup) {
                        foreach ($attrGroup->attrs as $attr) {
                            if ($node instanceof Node\Stmt\Class_) {
                                ($this->consumer)($this->getAnnotatedTargetFromClassNode($node, $index));
                            } else if ($node instanceof Node\Stmt\Property) {
                                foreach ($node->props as $prop) {
                                    ($this->consumer)($this->getAnnotatedTargetFromPropertyNode($prop, $index));
                                }
                            } else if ($node instanceof Node\Stmt\ClassConst) {
                                foreach ($node->consts as $const) {
                                    ($this->consumer)($this->getAnnotatedTargetFromClassConstantNode($const, $index));
                                }
                            } else if ($node instanceof Node\Stmt\ClassMethod) {
                                ($this->consumer)($this->getAnnotatedTargetFromMethodNode($node, $index));
                            } else if ($node instanceof Node\Param) {
                                ($this->consumer)($this->getAnnotatedTargetFromMethodParameter($node, $index));
                            } else {
                                ($this->consumer)($this->getAnnotatedTargetFromFunction($node, $index));
                            }
                            $index++;
                        }
                    }
                }
            }

            private function getAnnotatedTargetFromClassNode(Node\Stmt\Class_ $class, int $index) : AnnotatedTarget {
                $classType = $class->namespacedName->toString();
                return $this->getAnnotatedTarget(fn() => new ReflectionClass($classType), $index);
            }

            private function getAnnotatedTargetFromPropertyNode(Node\Stmt\PropertyProperty $property, int $index) : AnnotatedTarget {
                $classType = $property->getAttribute('parent')->getAttribute('parent')->namespacedName->toString();
                $propertyName = $property->name->toString();
                return $this->getAnnotatedTarget(fn() => new ReflectionProperty($classType, $propertyName), $index);
            }

            private function getAnnotatedTargetFromClassConstantNode(Node\Const_ $classConst, int $index) : AnnotatedTarget {
                $classType = $classConst->getAttribute('parent')->getAttribute('parent')->namespacedName->toString();
                $constName = $classConst->name->toString();
                return $this->getAnnotatedTarget(fn() => new ReflectionClassConstant($classType, $constName), $index);
            }

            private function getAnnotatedTargetFromMethodNode(Node\Stmt\ClassMethod $classMethod, int $index) : AnnotatedTarget {
                $classType = $classMethod->getAttribute('parent')->namespacedName->toString();
                $methodName = $classMethod->name->toString();
                return $this->getAnnotatedTarget(fn() => new ReflectionMethod(sprintf('%s::%s', $classType, $methodName)), $index);
            }

            private function getAnnotatedTargetFromMethodParameter(Node\Param $param, int $index) : AnnotatedTarget {
                $paramParent = $param->getAttribute('parent');
                if ($paramParent instanceof Node\Stmt\ClassMethod) {
                    $classType = $paramParent->getAttribute('parent')->namespacedName->toString();
                    $methodName = $paramParent->name->toString();
                    $callable = [$classType, $methodName];
                } else {
                    $callable = $paramParent->namespacedName->toString();
                }
                $paramName = $param->var->name;
                return $this->getAnnotatedTarget(fn() => new ReflectionParameter($callable, $paramName), $index);
            }

            private function getAnnotatedTargetFromFunction(Node\Stmt\Function_ $function, int $index) : AnnotatedTarget {
                $function = $function->namespacedName->toString();
                return $this->getAnnotatedTarget(fn() => new ReflectionFunction($function), $index);
            }

            private function getAnnotatedTarget(callable $reflectorSupplier, int $index) : AnnotatedTarget {
                return new class($reflectorSupplier, $index) implements AnnotatedTarget {

                    private $reflectorSupplier;
                    private ReflectionClass|ReflectionProperty|ReflectionClassConstant|ReflectionMethod|ReflectionParameter|ReflectionFunction $reflection;
                    private ReflectionAttribute $reflectionAttribute;
                    private object $attribute;

                    public function __construct(
                        callable $reflectorSupplier,
                        private readonly int $index
                    ) {
                        $this->reflectorSupplier = $reflectorSupplier;
                    }

                    public function getTargetReflection() : ReflectionClass|ReflectionProperty|ReflectionClassConstant|ReflectionMethod|ReflectionParameter|ReflectionFunction {
                        if (!isset($this->reflection)) {
                            $this->reflection = ($this->reflectorSupplier)();
                        }
                        return $this->reflection;
                    }

                    public function getAttributeReflection() : ReflectionAttribute {
                        if (!isset($this->reflectionAttribute)) {
                            $this->reflectionAttribute = $this->getTargetReflection()->getAttributes()[$this->index];
                        }
                        return $this->reflectionAttribute;
                    }

                    public function getAttributeInstance() : object {
                        if (!isset($this->attribute)) {
                            $this->attribute = $this->getAttributeReflection()->newInstance();
                        }
                        return $this->attribute;
                    }
                };
            }
        };
    }


}