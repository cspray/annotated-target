<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\Typiphy\ObjectType;
use Generator;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use ReflectionAttribute;
use ReflectionClass;
use function Cspray\Typiphy\objectType;

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
                if ($node instanceof Node\Stmt\Class_) {
                    /** @var Node\AttributeGroup $attr */
                    foreach ($node->attrGroups as $index => $attrGroup) {
                        foreach ($attrGroup->attrs as $attr) {
                            ($this->consumer)($this->getAnnotatedTargetFromClassNode($node, $index));
                        }
                    }
                }
            }

            private function getAnnotatedTargetFromClassNode(Node\Stmt\Class_ $class, int $index) : AnnotatedTarget {
                $classType = objectType($class->namespacedName->toString());
                return new class($classType, $index) implements AnnotatedTarget {

                    public function __construct(
                        private readonly ObjectType $classType,
                        private readonly int $index
                    ) {}

                    public function getTargetReflection() : ReflectionClass {
                        return new ReflectionClass($this->classType->getName());
                    }

                    public function getAttributeReflection() : ReflectionAttribute {
                        return $this->getTargetReflection()->getAttributes()[$this->index];
                    }

                    public function getAttributeInstance() : object {
                        return $this->getAttributeReflection()->newInstance();
                    }
                };
            }
        };
    }


}