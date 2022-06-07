<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\FunctionOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::functionOnlyAttributeSingleFunction());

it('counts targets for single constant')->assertTargetCount(1);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('contains target reflection function')
    ->containsTargetFunction(Fixtures::functionOnlyAttributeSingleFunction()->fooFunction());

it('contains target reflection function and reflection attribute')
    ->containsTargetFunctionAndAttribute(
        Fixtures::functionOnlyAttributeSingleFunction()->fooFunction(), objectType(FunctionOnly::class)
    );

it('contains target reflection function and attribute instance')
    ->containsTargetFunctionAndAttributeInstance(
        Fixtures::functionOnlyAttributeSingleFunction()->fooFunction(), objectType(FunctionOnly::class),
        fn(FunctionOnly $functionOnly) => $functionOnly->value === 'would a crazy person do this?'
    );