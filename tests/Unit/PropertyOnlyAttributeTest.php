<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\PropertyOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::propertyOnlyAttributeSingleClass());

$targets = fn() => $this->getTargets();

it('counts targets for single property')
    ->expect($targets)
    ->toHaveCount(1);

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
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop'
    );

it('includes attribute reflection property')
    ->expect($targets)
    ->toContainTargetPropertyWithAttribute(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop', objectType(PropertyOnly::class)
    );

it('includes attribute instance value')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop', objectType(PropertyOnly::class),
        fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'nick'
    );
