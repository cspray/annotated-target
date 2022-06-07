<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\FunctionOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::functionOnlyAttributeSingleFunction());

it('counts targets for single constant')
    ->expect(fn() => $this->getTargets())
    ->toHaveCount(1);

it('ensures all targets are correct types')
    ->expect(fn() => $this->getTargets())
    ->toContainOnlyAnnotatedTargets();

it('ensures all targets share target reflection')
    ->expect(fn() => $this->getTargets())
    ->toShareTargetReflection();

it('ensures all targets share attribute reflection')
    ->expect(fn() => $this->getTargets())
    ->toShareAttributeReflection();

it('ensures all targets share attribute instance')
    ->expect(fn() => $this->getTargets())
    ->toShareAttributeInstance();

it('contains target reflection function')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetFunction(Fixtures::functionOnlyAttributeSingleFunction()->fooFunction());

it('contains target reflection function and reflection attribute')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetFunctionWithAttribute(
        Fixtures::functionOnlyAttributeSingleFunction()->fooFunction(), objectType(FunctionOnly::class)
    );

it('contains target reflection function and attribute instance')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetFunctionWithAttributeInstance(
        Fixtures::functionOnlyAttributeSingleFunction()->fooFunction(), objectType(FunctionOnly::class),
        fn(FunctionOnly $functionOnly) => $functionOnly->value === 'would a crazy person do this?'
    );