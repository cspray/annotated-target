<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatableFunctionOnly;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::repeatableFunctionOnlyAttributeSingleFunction());

$targets = fn() => $this->getTargets();

it('counts targets for repeatable function')
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

it('contains target reflection function')
    ->expect($targets)
    ->toContainTargetFunction(Fixtures::repeatableFunctionOnlyAttributeSingleFunction()->fooFunction());

it('contains target reflection function and reflection attribute')
    ->expect($targets)
    ->toContainTargetFunctionWithAttribute(
        Fixtures::repeatableFunctionOnlyAttributeSingleFunction()->fooFunction(), RepeatableFunctionOnly::class
    );

it('contains target reflection function and first attribute instance')
    ->expect($targets)
    ->toContainTargetFunctionWithAttributeInstance(
        Fixtures::repeatableFunctionOnlyAttributeSingleFunction()->fooFunction(), RepeatableFunctionOnly::class,
        static fn(RepeatableFunctionOnly $functionOnly) => $functionOnly->value === 'nick'
    );

it('contains target reflection function and second attribute instance')
    ->expect($targets)
    ->toContainTargetFunctionWithAttributeInstance(
        Fixtures::repeatableFunctionOnlyAttributeSingleFunction()->fooFunction(), RepeatableFunctionOnly::class,
        static fn(RepeatableFunctionOnly $functionOnly) => $functionOnly->value === 'xoe'
    );
