<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatableClassOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::classOnlyAttributeGroupSingleClass());

it('counts parsed targets for single class')->assertTargetCount(4);

it('ensures all targets are correct type')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('includes target reflection class')
    ->assertContainsTargetReflectionClassType(Fixtures::classOnlyAttributeGroupSingleClass()->fooClass());

it('includes grouped attribute reflection class')
    ->assertContainsTargetReflectionClassTypeAndReflectionAttributeType(Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(), objectType(RepeatableClassOnly::class));

it('includes single attribute reflection class')
    ->assertContainsTargetReflectionClassTypeAndReflectionAttributeType(Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(), objectType(ClassOnly::class));

it('includes attribute instance with correct first value')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'foo'
    );

it('includes attribute instance with correct second value')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'bar'
    );

it('includes ungrouped attribute instance with correct value')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(),
        objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'baz'
    );

it('includes attribute instance with correct third value')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'qux'
    );
