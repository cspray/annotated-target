<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatablePropertyOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::repeatablePropertyOnlyAttributeSingleClass());

it('counts targets for single class')->assertTargetCount(3);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('includes target reflection property')->containsTargetProperty(
    Fixtures::repeatablePropertyOnlyAttributeSingleClass()->fooClass(), 'something'
);

it('includes attribute reflection')->containsTargetPropertyAndAttribute(
    Fixtures::repeatablePropertyOnlyAttributeSingleClass()->fooClass(), 'something', objectType(RepeatablePropertyOnly::class)
);

it('includes first attribute instance value')->containsTargetPropertyAndAttributeInstance(
    Fixtures::repeatablePropertyOnlyAttributeSingleClass()->fooClass(), 'something', objectType(RepeatablePropertyOnly::class),
    fn(RepeatablePropertyOnly $propertyOnly) => $propertyOnly->value === 'Archer'
);

it('includes second attribute instance value')->containsTargetPropertyAndAttributeInstance(
    Fixtures::repeatablePropertyOnlyAttributeSingleClass()->fooClass(), 'something', objectType(RepeatablePropertyOnly::class),
    fn(RepeatablePropertyOnly $propertyOnly) => $propertyOnly->value === 'Lana'
);

it('includes third attribute instance value')->containsTargetPropertyAndAttributeInstance(
    Fixtures::repeatablePropertyOnlyAttributeSingleClass()->fooClass(), 'something', objectType(RepeatablePropertyOnly::class),
    fn(RepeatablePropertyOnly $propertyOnly) => $propertyOnly->value === 'Ray'
);
