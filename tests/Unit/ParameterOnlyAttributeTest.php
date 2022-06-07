<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\ParameterOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::parameterOnlyAttributeSingleClass());

it('counts targets for single parameter')->assertTargetCount(1);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('contains target reflection parameter')
    ->containsTargetMethodParameter(
        Fixtures::parameterOnlyAttributeSingleClass()->fooClass(), 'myMethod', 'myParam'
    );

it('contains target reflection and attribute')
    ->containsTargetMethodParameterAndAttribute(
        Fixtures::parameterOnlyAttributeSingleClass()->fooClass(), 'myMethod', 'myParam', objectType(ParameterOnly::class)
    );

it('contains target reflection and attribute instance')
    ->containsTargetMethodParameterAndAttributeInstance(
        Fixtures::parameterOnlyAttributeSingleClass()->fooClass(), 'myMethod', 'myParam', objectType(ParameterOnly::class),
        fn(ParameterOnly $parameterOnly) => $parameterOnly->value === 'myParamValue'
    );