<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatablePropertyOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::repeatablePropertyOnlyAttributeSingleClass());

$targets = fn() => $this->getTargets();

it('counts targets for single class')
    ->expect($targets)
    ->toHaveCount(3);

it('ensures all targets are correct types')
    ->expect($targets)
    ->toContainOnlyAnnotatedTargets();

it('ensures all targets share target reflection')
    ->expect($targets)
    ->toShareTargetReflection();

it('ensures all targets share attribute reflection')
    ->expect($targets)
    ->toShareAttributeReflection();

it('ensures all targets share attribute instance')
    ->expect($targets)
    ->toShareAttributeInstance();

it('includes target reflection property')
    ->expect($targets)
    ->toContainTargetProperty(
        Fixtures::repeatablePropertyOnlyAttributeSingleClass()->fooClass(), 'something'
    );

it('includes attribute reflection')
    ->expect($targets)
    ->toContainTargetPropertyWithAttribute(
        Fixtures::repeatablePropertyOnlyAttributeSingleClass()->fooClass(), 'something', objectType(RepeatablePropertyOnly::class)
    );

it('includes first attribute instance value')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::repeatablePropertyOnlyAttributeSingleClass()->fooClass(), 'something', objectType(RepeatablePropertyOnly::class),
        fn(RepeatablePropertyOnly $propertyOnly) => $propertyOnly->value === 'Archer'
    );

it('includes second attribute instance value')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::repeatablePropertyOnlyAttributeSingleClass()->fooClass(), 'something', objectType(RepeatablePropertyOnly::class),
        fn(RepeatablePropertyOnly $propertyOnly) => $propertyOnly->value === 'Lana'
    );

it('includes third attribute instance value')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::repeatablePropertyOnlyAttributeSingleClass()->fooClass(), 'something', objectType(RepeatablePropertyOnly::class),
        fn(RepeatablePropertyOnly $propertyOnly) => $propertyOnly->value === 'Ray'
    );
