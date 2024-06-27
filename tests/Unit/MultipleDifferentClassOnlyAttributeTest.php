<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatableClassOnly;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::multipleDifferentClassOnlyAttributeSingleClass());

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

it('includes target reflection class')
    ->expect($targets)
    ->toContainTargetClass(Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass());

it('includes attribute reflection class for class only')
    ->expect($targets)
    ->toContainTargetClassWithAttribute(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        ClassOnly::class
    );

it('includes attribute reflection class for repeatable class only')
    ->expect($targets)
    ->toContainTargetClassWithAttribute(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        RepeatableClassOnly::class
    );

it('includes attribute instance for class only')
    ->expect($targets)
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        ClassOnly::class,
        static fn(ClassOnly $classOnly) => $classOnly->value === 'foo'
    );

it('includes attribute instance for first repeatable class only')
    ->expect($targets)
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        RepeatableClassOnly::class,
        static fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'bar'
);

it('includes attribute instance for second repeatable class only')
    ->expect($targets)
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::multipleDifferentClassOnlyAttributeSingleClass()->fooClass(),
        RepeatableClassOnly::class,
        static fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'baz'
    );