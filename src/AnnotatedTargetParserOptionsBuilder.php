<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Exception\InvalidArgumentException;
use Cspray\Typiphy\ObjectType;

final class AnnotatedTargetParserOptionsBuilder {

    private array $directories = [];
    private array $attributes = [];

    private function __construct() {}

    public static function scanDirectories(string... $dirs) : self {
        $instance = new self;
        foreach ($dirs as $dir) {
            if (empty($dir)) {
                throw new InvalidArgumentException('The directories to scan must not include an empty value.');
            } else if (!is_dir($dir)) {
                throw new InvalidArgumentException(sprintf("The value '%s' is not a directory.", $dir));
            }

            $instance->directories[] = $dir;
        }
        return $instance;
    }

    public function filterAttributes(ObjectType... $attributes) : self {
        if (empty($attributes)) {
            throw new InvalidArgumentException('The Attributes to filter by must not be empty.');
        }
        $instance = clone $this;
        $instance->attributes = [...$this->attributes, ...$attributes];
        return $instance;
    }

    public function build() : AnnotatedTargetParserOptions {
        return new class($this->directories, $this->attributes) implements AnnotatedTargetParserOptions {

            public function __construct(private readonly array $directories, private readonly array $attributes) {}

            public function getSourceDirectories() : array {
                return $this->directories;
            }

            public function getAttributeTypes() : array {
                return $this->attributes;
            }
        };
    }

}