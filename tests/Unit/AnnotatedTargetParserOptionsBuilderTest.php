<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTarget\AnnotatedTargetParserOptionsBuilder;
use Cspray\AnnotatedTarget\Exception\InvalidArgumentException;
use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\MethodOnly;
use function Cspray\Typiphy\objectType;

it('throws exception if directories is empty', function() {
    AnnotatedTargetParserOptionsBuilder::scanDirectories('');
})->throws(InvalidArgumentException::class, 'The directories to scan must not include an empty value.');

it('throws exception if directories is not a directory', function() {
    AnnotatedTargetParserOptionsBuilder::scanDirectories('not-dir');
})->throws(InvalidArgumentException::class, "The value 'not-dir' is not a directory.");

it('throws exception if attributes is empty', function() {
    AnnotatedTargetParserOptionsBuilder::scanDirectories(Fixtures::classOnlyAttributeSingleClass()->getPath())->filterAttributes();
})->throws(InvalidArgumentException::class, 'The Attributes to filter by must not be empty.');

it('has scan directories in options')
    ->expect(function() {
        $options = AnnotatedTargetParserOptionsBuilder::scanDirectories(Fixtures::classOnlyAttributeSingleClass()->getPath())->build();
        return $options->getSourceDirectories();
    })
    ->toBe([Fixtures::classOnlyAttributeSingleClass()->getPath()]);

it('has different instance for filterAttributes', function() {
    $builder = AnnotatedTargetParserOptionsBuilder::scanDirectories(Fixtures::classOnlyAttributeSingleClass()->getPath());
    $filterBuilder = $builder->filterAttributes(objectType(ClassOnly::class));
    expect($builder)->not->toBe($filterBuilder);
});

it('has empty filterAttributes in options')
    ->expect(function() {
        $options = AnnotatedTargetParserOptionsBuilder::scanDirectories(Fixtures::classOnlyAttributeSingleClass()->getPath())->build();
        return $options->getAttributeTypes();
    })->toBeEmpty();

it('has populated filterAttributes in options')
    ->expect(function() {
        $options = AnnotatedTargetParserOptionsBuilder::scanDirectories(Fixtures::classOnlyAttributeSingleClass()->getPath())
            ->filterAttributes(objectType(ClassOnly::class))
            ->build();
        return $options->getAttributeTypes();
    })->toBe([objectType(ClassOnly::class)]);

it('has populated filterAttributes in options, when chained')
    ->expect(function() {
        $options = AnnotatedTargetParserOptionsBuilder::scanDirectories(Fixtures::classOnlyAttributeSingleClass()->getPath())
            ->filterAttributes(objectType(ClassOnly::class))
            ->filterAttributes(objectType(MethodOnly::class))
            ->build();
        return $options->getAttributeTypes();
    })->toBe([objectType(ClassOnly::class), objectType(MethodOnly::class)]);