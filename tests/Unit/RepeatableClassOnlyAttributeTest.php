<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatableClassOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::repeatableClassOnlyAttributeSingleClass());

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
    ->toContainTargetClass(Fixtures::repeatableClassOnlyAttributeSingleClass()->fooClass());

it('includes attribute reflection class')
    ->expect($targets)
    ->toContainTargetClassWithAttribute(
        Fixtures::repeatableClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class)
    );

it('includes first attribute value')
    ->expect($targets)
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::repeatableClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'foo'
    );

it('includes second attribute value')
    ->expect($targets)
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::repeatableClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'bar'
    );

it('includes third attribute value')
    ->expect($targets)
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::repeatableClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'baz'
    );