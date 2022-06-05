<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Exception\InvalidArgumentException;

it('throws exception if directories is empty', function() {
    AnnotatedTargetParserOptionsBuilder::scanDirectories('');
})->throws(InvalidArgumentException::class, 'The directories to scan must not include an empty value.');

it('throws exception if directories is not a directory', function() {
    AnnotatedTargetParserOptionsBuilder::scanDirectories('not-dir');
})->throws(InvalidArgumentException::class, "The value 'not-dir' is not a directory.");
