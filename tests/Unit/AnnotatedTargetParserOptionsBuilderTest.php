<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Exception\InvalidArgumentException;
use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\ClassOnlyFixtures;
use Cspray\AnnotatedTargetFixture\Fixture;
use function Cspray\Typiphy\objectType;

it('throws exception if directories is empty', function() {
    AnnotatedTargetParserOptionsBuilder::scanDirectories('');
})->throws(InvalidArgumentException::class, 'The directories to scan must not include an empty value.');

it('throws exception if directories is not a directory', function() {
    AnnotatedTargetParserOptionsBuilder::scanDirectories('not-dir');
})->throws(InvalidArgumentException::class, "The value 'not-dir' is not a directory.");

it('throws exception if attributes is empty', function() {
    AnnotatedTargetParserOptionsBuilder::scanDirectories(ClassOnlyFixtures::singleClass()->getPath())->filterAttributes();
})->throws(InvalidArgumentException::class, 'The Attributes to filter by must not be empty.');

it('has scan directories in options path')
    ->expect(fn() => AnnotatedTargetParserOptionsBuilder::scanDirectories(ClassOnlyFixtures::singleClass()->getPath())->build()->getSourceDirectories())
    ->toBe([ClassOnlyFixtures::singleClass()->getPath()]);