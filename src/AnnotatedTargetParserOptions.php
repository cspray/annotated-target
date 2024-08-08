<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

final class AnnotatedTargetParserOptions {

    /**
     * @param non-empty-list<non-empty-string> $sourceDirectories
     * @param list<class-string> $filteredAttributes
     */
    private function __construct(
        public readonly array $sourceDirectories,
        public readonly array $filteredAttributes
    ) {}

    /**
     * @param non-empty-string $path
     * @param non-empty-string ...$additionalPaths
     * @return self
     */
    public static function scanAllAttributes(string $path, string... $additionalPaths) : self {
        return new self(array_values([$path, ...$additionalPaths]), []);
    }

    /**
     * @param non-empty-list<non-empty-string> $paths
     * @param non-empty-list<class-string> $attributes
     */
    public static function scanForSpecificAttributes(array $paths, array $attributes) : self {
        return new self($paths, $attributes);
    }

}
