<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Exception\InvalidArgumentException;
use Cspray\AnnotatedTarget\Exception\InvalidPhpSyntax;
use Generator;

/**
 * @param non-empty-list<non-empty-string>|non-empty-string $directories
 * @param list<class-string> $filterAttributes
 * @return Generator<AnnotatedTarget>
 * @throws InvalidArgumentException
 * @throws InvalidPhpSyntax
 */
function parseAttributes(array|string $directories, array $filterAttributes = []) : Generator {
    $parser = new PhpParserAnnotatedTargetParser();
    $directories = is_string($directories) ? [$directories] : $directories;

    if ($filterAttributes === []) {
        $options = AnnotatedTargetParserOptions::scanAllAttributes(...$directories);
    } else {
        $options = AnnotatedTargetParserOptions::scanForSpecificAttributes($directories, $filterAttributes);
    }

    return $parser->parse($options);
}