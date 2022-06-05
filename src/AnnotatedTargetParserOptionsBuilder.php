<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Exception\InvalidArgumentException;

final class AnnotatedTargetParserOptionsBuilder {

    private function __construct() {}

    public static function scanDirectories(string... $dirs) : self {
        throw new InvalidArgumentException('The directories to scan must not include an empty value.');
    }

    public function withAttributeTypes() : self {

    }

    public function build() : AnnotatedTargetParserOptions {

    }

}