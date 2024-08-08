<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Unit\AnnotatedTargetParserTestCase;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\MethodOnly;
use Cspray\AnnotatedTargetFixture\RepeatableMethodOnly;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::repeatableMethodOnlyAttributeSingleClass());

$targets = fn() => $this->getTargets();

it('counts targets for single constant')
    ->expect($targets)
    ->toHaveCount(2);

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

it('contains target reflection method')
    ->expect($targets)
    ->toContainTargetMethod(
        Fixtures::repeatableMethodOnlyAttributeSingleClass()->fooClass(), 'theirMethod'
    );

it('contains target reflection method and first attribute')
    ->expect($targets)
    ->toContainTargetMethodWithAttribute(
        Fixtures::repeatableMethodOnlyAttributeSingleClass()->fooClass(), 'theirMethod', MethodOnly::class
    );

it('contains target reflection method and second attribute')
    ->expect($targets)
    ->toContainTargetMethodWithAttribute(
        Fixtures::repeatableMethodOnlyAttributeSingleClass()->fooClass(), 'theirMethod', RepeatableMethodOnly::class
    );

it('contains target reflection method and first attribute instance')
    ->expect($targets)
    ->toContainTargetMethodWithAttributeInstance(
        Fixtures::repeatableMethodOnlyAttributeSingleClass()->fooClass(), 'theirMethod', MethodOnly::class,
        static fn(MethodOnly $methodOnly) => $methodOnly->value === 'methodOnly'
    );

it('contains target reflection method and second attribute instance')
    ->expect($targets)
    ->toContainTargetMethodWithAttributeInstance(
        Fixtures::repeatableMethodOnlyAttributeSingleClass()->fooClass(), 'theirMethod', RepeatableMethodOnly::class,
        static fn(RepeatableMethodOnly $methodOnly) => $methodOnly->value === 'repeatableMethodOnly'
    );