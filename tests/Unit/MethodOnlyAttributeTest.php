<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Unit\AnnotatedTargetParserTestCase;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\MethodOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::methodOnlyAttributeSingleClass());

$targets = fn() => $this->getTargets();

it('counts targets for single constant')
    ->expect($targets)
    ->toHaveCount(1);

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

it('has target reflection method')
    ->expect($targets)
    ->toContainTargetMethod(
        Fixtures::methodOnlyAttributeSingleClass()->fooClass(), 'myMethod'
    );

it('has target reflection method and attribute')
    ->expect($targets)
    ->toContainTargetMethodWithAttribute(
        Fixtures::methodOnlyAttributeSingleClass()->fooClass(), 'myMethod', objectType(MethodOnly::class)
    );

it('has target method and attribute instance')
    ->expect($targets)
    ->toContainTargetMethodWithAttributeInstance(
        Fixtures::methodOnlyAttributeSingleClass()->fooClass(), 'myMethod', objectType(MethodOnly::class),
        fn(MethodOnly $methodOnly) => $methodOnly->value === 'is the coolest method'
    );
