<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatableClassOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::repeatableClassOnlyAttributeSingleClass());

it('counts targets for single class')->assertTargetCount(3);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('includes target reflection class')
    ->assertContainsTargetReflectionClassType(Fixtures::repeatableClassOnlyAttributeSingleClass()->fooClass());

it('includes attribute reflection class')
    ->assertContainsTargetReflectionClassTypeAndReflectionAttributeType(
        Fixtures::repeatableClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class)
    );

it('includes first attribute value')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::repeatableClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'foo'
    );

it('includes second attribute value')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::repeatableClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'bar'
    );

it('includes third attribute value')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::repeatableClassOnlyAttributeSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'baz'
    );