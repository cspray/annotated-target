<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\ParameterOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::functionParameterOnlyAttributeSingleFunction());

$targets = fn() => $this->getTargets();

it('counts targets for single parameter')
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

it('contains target reflection parameter')
    ->expect($targets)
    ->toContainTargetFunctionParameter(
        Fixtures::functionParameterOnlyAttributeSingleFunction()->fooFunction(), 'param'
    );

it('contains target reflection and attribute')
    ->expect($targets)
    ->toContainTargetFunctionParameterWithAttribute(
        Fixtures::functionParameterOnlyAttributeSingleFunction()->fooFunction(), 'param', objectType(ParameterOnly::class)
    );

it('contains target reflection and attribute instance')
    ->expect($targets)
    ->toContainTargetFunctionParameterWithAttributeInstance(
        Fixtures::functionParameterOnlyAttributeSingleFunction()->fooFunction(), 'param', objectType(ParameterOnly::class),
        fn(ParameterOnly $parameterOnly) => $parameterOnly->value === 'awesome'
    );