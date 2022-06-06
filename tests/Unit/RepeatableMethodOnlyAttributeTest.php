<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Unit\AnnotatedTargetParserTestCase;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\MethodOnly;
use Cspray\AnnotatedTargetFixture\RepeatableMethodOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::repeatableMethodOnlyAttributeSingleClass());

it('counts targets for single constant')->assertTargetCount(2);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('contains target reflection method')
    ->containsTargetReflectionMethod(
        Fixtures::repeatableMethodOnlyAttributeSingleClass()->fooClass(), 'theirMethod'
    );

it('contains target reflection method and first attribute')
    ->containsTargetReflectionMethodAndReflectionAttribute(
        Fixtures::repeatableMethodOnlyAttributeSingleClass()->fooClass(), 'theirMethod', objectType(MethodOnly::class)
    );

it('contains target reflection method and second attribute')
    ->containsTargetReflectionMethodAndReflectionAttribute(
        Fixtures::repeatableMethodOnlyAttributeSingleClass()->fooClass(), 'theirMethod', objectType(RepeatableMethodOnly::class)
    );

it('contains target reflection method and first attribute instance')
    ->containsReflectionMethodReflectionAttributeAndAttributeInstance(
        Fixtures::repeatableMethodOnlyAttributeSingleClass()->fooClass(), 'theirMethod', objectType(MethodOnly::class),
        fn(MethodOnly $methodOnly) => $methodOnly->value === 'methodOnly'
    );

it('contains target reflection method and second attribute instance')
    ->containsReflectionMethodReflectionAttributeAndAttributeInstance(
        Fixtures::repeatableMethodOnlyAttributeSingleClass()->fooClass(), 'theirMethod', objectType(RepeatableMethodOnly::class),
        fn(RepeatableMethodOnly $methodOnly) => $methodOnly->value === 'repeatableMethodOnly'
    );