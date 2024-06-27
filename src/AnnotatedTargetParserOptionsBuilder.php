<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Exception\InvalidArgumentException;
use Cspray\Typiphy\ObjectType;

final class AnnotatedTargetParserOptionsBuilder {

    private array $directories = [];
    private array $attributes = [];

    private function __construct() {}

    /**
     * @param non-empty-list<non-empty-string> $dirs
     * @return self
     * @throws InvalidArgumentException
     */
    public static function scanDirectories(array $dirs) : self {
        $instance = new self;
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                throw new InvalidArgumentException(sprintf("The value '%s' is not a directory.", $dir));
            }

            $instance->directories[] = $dir;
        }
        return $instance;
    }

    /**
     * @param non-empty-list<class-string> $attributes
     */
    public function filterAttributes(array $attributes) : self {
        $instance = clone $this;
        $instance->attributes = [...$this->attributes, ...$attributes];
        return $instance;
    }

    public function build() : AnnotatedTargetParserOptions {
        return new class($this->directories, $this->attributes) implements AnnotatedTargetParserOptions {

            public function __construct(private readonly array $directories, private readonly array $attributes) {}

            public function sourceDirectories() : array {
                return $this->directories;
            }

            public function attributeTypes() : array {
                return $this->attributes;
            }
        };
    }

}