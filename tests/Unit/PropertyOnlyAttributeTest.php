<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\PropertyOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::propertyOnlyAttributeSingleClass());

it('counts targets for single property')->assertTargetCount(1);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('includes target reflection property')
    ->containsTargetProperty(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop'
    );

it('includes attribute reflection property')
    ->containsTargetPropertyAndAttribute(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop', objectType(PropertyOnly::class)
    );

it('includes attribute instance value')
    ->containsTargetPropertyAndAttributeInstance(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop', objectType(PropertyOnly::class),
        fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'nick'
    );
