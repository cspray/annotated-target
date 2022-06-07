<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\PropertyOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::classOnlyAttributeSingleClass(), Fixtures::propertyOnlyAttributeSingleClass());

it('counts targets for single class')->assertTargetCount(2);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('contains class attribute target')
    ->containsTargetClass(Fixtures::classOnlyAttributeSingleClass()->fooClass());

it('contains class attribute target and attribute')
    ->containsTargetClassAndAttribute(Fixtures::classOnlyAttributeSingleClass()->fooClass(), objectType(ClassOnly::class));

it('contains class attribute target and attribute instance')
    ->containsTargetClassAndAttributeInstance(
        Fixtures::classOnlyAttributeSingleClass()->fooClass(), objectType(ClassOnly::class),
        fn($classOnly) => $classOnly instanceof ClassOnly && $classOnly->value === 'single-class-foobar'
    );

it('contains property attribute target')
    ->containsTargetProperty(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop'
    );

it('contains property attribute target and attribute')
    ->containsTargetPropertyAndAttribute(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop', objectType(PropertyOnly::class)
    );

it('contains property attribute target and attribute instance')
    ->containsTargetPropertyAndAttributeInstance(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop', objectType(PropertyOnly::class),
        fn($propertyOnly) => $propertyOnly instanceof PropertyOnly && $propertyOnly->value === 'nick'
    );