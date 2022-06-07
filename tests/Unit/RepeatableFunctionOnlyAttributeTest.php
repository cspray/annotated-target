<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\FunctionOnly;
use Cspray\AnnotatedTargetFixture\RepeatableFunctionOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::repeatableFunctionOnlyAttributeSingleFunction());

it('counts targets for repeatable function')->assertTargetCount(2);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('contains target reflection function')
    ->containsTargetFunction(Fixtures::repeatableFunctionOnlyAttributeSingleFunction()->fooFunction());

it('contains target reflection function and reflection attribute')
    ->containsTargetFunctionAndAttribute(
        Fixtures::repeatableFunctionOnlyAttributeSingleFunction()->fooFunction(), objectType(RepeatableFunctionOnly::class)
    );

it('contains target reflection function and first attribute instance')
    ->containsTargetFunctionAndAttributeInstance(
        Fixtures::repeatableFunctionOnlyAttributeSingleFunction()->fooFunction(), objectType(RepeatableFunctionOnly::class),
        fn(RepeatableFunctionOnly $functionOnly) => $functionOnly->value === 'nick'
    );

it('contains target reflection function and second attribute instance')
    ->containsTargetFunctionAndAttributeInstance(
        Fixtures::repeatableFunctionOnlyAttributeSingleFunction()->fooFunction(), objectType(RepeatableFunctionOnly::class),
        fn(RepeatableFunctionOnly $functionOnly) => $functionOnly->value === 'xoe'
    );
