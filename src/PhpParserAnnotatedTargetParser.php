<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Generator;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionMethod;
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

        /** @var \SplFileInfo $sourceFile */
        foreach ($this->getSourceIterator($options) as $sourceFile) {
            $nodes = $this->parser->parse(file_get_contents($sourceFile->getPathname()));
            $nodeTraverser->traverse($nodes);
            yield from $data->targets;
        }
    }

    private function getSourceIterator(AnnotatedTargetParserOptions $options) : \Iterator {
        return new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($options->getSourceDirectories()[0], \FilesystemIterator::SKIP_DOTS)
        );
    }

    private function getVisitor(callable $consumer) : NodeVisitor {
        return new class($consumer) extends NodeVisitorAbstract {

            private $consumer;

            public function __construct(callable $consumer) {
                $this->consumer = $consumer;
            }

            public function leaveNode(Node $node) {
                if ($node instanceof Node\Stmt\Class_ || $node instanceof Node\Stmt\Property ||
                    $node instanceof Node\Stmt\ClassConst || $node instanceof Node\Stmt\ClassMethod) {
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
                            } else {
                                ($this->consumer)($this->getAnnotatedTargetFromMethodNode($node, $index));
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

            private function getAnnotatedTarget(callable $reflectorSupplier, int $index) : AnnotatedTarget {
                return new class($reflectorSupplier, $index) implements AnnotatedTarget {

                    private $reflectorSupplier;
                    private ReflectionClass|ReflectionProperty|ReflectionClassConstant|ReflectionMethod $reflectionClass;
                    private ReflectionAttribute $reflectionAttribute;
                    private object $attribute;

                    public function __construct(
                        callable $reflectorSupplier,
                        private readonly int $index
                    ) {
                        $this->reflectorSupplier = $reflectorSupplier;
                    }

                    public function getTargetReflection() : ReflectionClass|ReflectionProperty|ReflectionClassConstant|ReflectionMethod {
                        if (!isset($this->reflectionClass)) {
                            $this->reflectionClass = ($this->reflectorSupplier)();
                        }
                        return $this->reflectionClass;
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