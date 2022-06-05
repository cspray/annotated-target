<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Exception\InvalidArgumentException;

final class AnnotatedTargetParserOptionsBuilder {

    private function __construct() {}

    public static function scanDirectories(string... $dirs) : self {
        foreach ($dirs as $dir) {
            if (empty($dir)) {
                throw new InvalidArgumentException('The directories to scan must not include an empty value.');
            } else if (!is_dir($dir)) {
                throw new InvalidArgumentException(sprintf("The value '%s' is not a directory.", $dir));
            }
        }
    }

    public function withAttributeTypes() : self {

    }

    public function build() : AnnotatedTargetParserOptions {

    }

}