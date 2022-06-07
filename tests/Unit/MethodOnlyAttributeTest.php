<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Unit\AnnotatedTargetParserTestCase;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\MethodOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::methodOnlyAttributeSingleClass());

it('counts targets for single constant')->assertTargetCount(1);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('has target reflection method')
    ->containsTargetMethod(
        Fixtures::methodOnlyAttributeSingleClass()->fooClass(), 'myMethod'
    );

it('has target reflection method and attribute')
    ->containsTargetMethodAndAttribute(
        Fixtures::methodOnlyAttributeSingleClass()->fooClass(), 'myMethod', objectType(MethodOnly::class)
    );

it('has target method and attribute instance')
    ->containsTargetMethodAndAttributeInstance(
        Fixtures::methodOnlyAttributeSingleClass()->fooClass(), 'myMethod', objectType(MethodOnly::class),
        fn(MethodOnly $methodOnly) => $methodOnly->value === 'is the coolest method'
    );
