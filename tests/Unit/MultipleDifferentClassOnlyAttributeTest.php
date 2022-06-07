<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatableClassOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::multipleDifferentClassOnlyAttributeSingleClass());

it('counts targets for single class')->assertTargetCount(3);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('includes target reflection class')
    ->containsTargetClass(Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass());

it('includes attribute reflection class for class only')
    ->containsTargetClassAndAttribute(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        objectType(ClassOnly::class)
    );

it('includes attribute reflection class for repeatable class only')
    ->containsTargetClassAndAttribute(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class)
    );

it('includes attribute instance for class only')
    ->containsTargetClassAndAttributeInstance(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'foo'
    );

it('includes attribute instance for first repeatable class only')
    ->containsTargetClassAndAttributeInstance(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'bar'
);

it('includes attribute instance for second repeatable class only')
    ->containsTargetClassAndAttributeInstance(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'baz'
    );