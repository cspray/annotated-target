<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatableClassOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::multipleDifferentClassOnlyAttributeSingleClass());

it('counts targets for single class')->assertTargetCount(3);

it('ensures all targets are correct types')->assertTargetTypes();

it('includes target reflection class')
    ->assertContainsTargetReflectionClassType(Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass());

it('includes attribute reflection class for class only')
    ->assertContainsTargetReflectionClassTypeAndReflectionAttributeType(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        objectType(ClassOnly::class)
    );

it('includes attribute reflection class for repeatable class only')
    ->assertContainsTargetReflectionClassTypeAndReflectionAttributeType(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class)
    );

it('includes attribute instance for class only')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'foo'
    );

it('includes attribute instance for first repeatable class only')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'bar'
);

it('includes attribute instance for second repeatable class only')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'baz'
    );