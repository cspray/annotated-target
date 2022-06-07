<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\ParameterOnly;
use Cspray\AnnotatedTargetFixture\RepeatableClassOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::classOnlyAttributeGroupSingleClass());

it('has correct target count')
    ->expect(fn() => $this->getTargets())
    ->toHaveCount(4);

it('has targets with correct type')
    ->expect(fn() => $this->getTargets())
    ->toContainOnlyAnnotatedTargets();

it('has shared target reflections')
    ->expect(fn() => $this->getTargets())
    ->toShareTargetReflection();

it('ensures all targets share attribute reflection')
    ->expect(fn() => $this->getTargets())
    ->toShareAttributeReflection();

it('ensures all targets share attribute instance')
    ->expect(fn() => $this->getTargets())
    ->toShareAttributeInstance();

it('includes target reflection class')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClass(Fixtures::classOnlyAttributeGroupSingleClass()->fooClass());

it('includes grouped attribute reflection class')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassWithAttribute(
        Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(), objectType(RepeatableClassOnly::class)
    );

it('includes single attribute reflection class')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassWithAttribute(
        Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(), objectType(ClassOnly::class)
    );

it('includes attribute instance with correct first value')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'foo'
    );

it('includes attribute instance with correct second value')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'bar'
    );

it('includes ungrouped attribute instance with correct value')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(),
        objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'baz'
    );

it('includes attribute instance with correct third value')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::classOnlyAttributeGroupSingleClass()->fooClass(),
        objectType(RepeatableClassOnly::class),
        fn(RepeatableClassOnly $classOnly) => $classOnly->value === 'qux'
    );
