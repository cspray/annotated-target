<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Exception\InvalidArgumentException;

it('throws exception if directories is empty', function() {
    AnnotatedTargetParserOptionsBuilder::scanDirectories('');
})->throws(InvalidArgumentException::class, 'The directories to scan must not include an empty value.');