<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\ParameterOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::parameterOnlyAttributeSingleClass());

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
    ->toContainTargetMethodParameter(
        Fixtures::parameterOnlyAttributeSingleClass()->fooClass(), 'myMethod', 'myParam'
    );

it('contains target reflection and attribute')
    ->expect($targets)
    ->toContainTargetMethodParameterWithAttribute(
        Fixtures::parameterOnlyAttributeSingleClass()->fooClass(), 'myMethod', 'myParam', objectType(ParameterOnly::class)
    );

it('contains target reflection and attribute instance')
    ->expect($targets)
    ->toContainTargetMethodParameterWithAttributeInstance(
        Fixtures::parameterOnlyAttributeSingleClass()->fooClass(), 'myMethod', 'myParam', objectType(ParameterOnly::class),
        fn(ParameterOnly $parameterOnly) => $parameterOnly->value === 'myParamValue'
    );