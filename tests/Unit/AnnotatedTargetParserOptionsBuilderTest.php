<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTarget\AnnotatedTargetParserOptionsBuilder;
use Cspray\AnnotatedTarget\Exception\InvalidArgumentException;
use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\MethodOnly;

it('throws exception if directories is not a directory', function() {
    AnnotatedTargetParserOptionsBuilder::scanDirectories(['not-dir']);
})->throws(InvalidArgumentException::class, "The value 'not-dir' is not a directory.");

it('has scan directories in options')
    ->expect(function() {
        $options = AnnotatedTargetParserOptionsBuilder::scanDirectories([Fixtures::classOnlyAttributeSingleClass()->getPath()])->build();
        return $options->sourceDirectories();
    })
    ->toBe([Fixtures::classOnlyAttributeSingleClass()->getPath()]);

it('has different instance for filterAttributes', function() {
    $builder = AnnotatedTargetParserOptionsBuilder::scanDirectories([Fixtures::classOnlyAttributeSingleClass()->getPath()]);
    $filterBuilder = $builder->filterAttributes([ClassOnly::class]);
    expect($builder)->not->toBe($filterBuilder);
});

it('has empty filterAttributes in options')
    ->expect(function() {
        $options = AnnotatedTargetParserOptionsBuilder::scanDirectories([Fixtures::classOnlyAttributeSingleClass()->getPath()])->build();
        return $options->attributeTypes();
    })->toBeEmpty();

it('has populated filterAttributes in options')
    ->expect(function() {
        $options = AnnotatedTargetParserOptionsBuilder::scanDirectories([Fixtures::classOnlyAttributeSingleClass()->getPath()])
            ->filterAttributes([ClassOnly::class])
            ->build();
        return $options->attributeTypes();
    })->toBe([ClassOnly::class]);

it('has populated filterAttributes in options, when chained')
    ->expect(function() {
        $options = AnnotatedTargetParserOptionsBuilder::scanDirectories([Fixtures::classOnlyAttributeSingleClass()->getPath()])
            ->filterAttributes([ClassOnly::class])
            ->filterAttributes([MethodOnly::class])
            ->build();
        return $options->attributeTypes();
    })->toBe([ClassOnly::class, MethodOnly::class]);