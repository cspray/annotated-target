<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\ParameterOnly;
use Cspray\AnnotatedTargetFixture\RepeatableParameterOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::repeatableParameterOnlyAttributeSingleClass());

it('counts targets for single parameter')->assertTargetCount(2);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('contains target reflection parameter')
    ->containsTargetMethodParameter(
        Fixtures::repeatableParameterOnlyAttributeSingleClass()->fooClass(), '__construct', 'baz'
    );

it('contains target reflection and attribute')
    ->containsTargetMethodParameterAndAttribute(
        Fixtures::repeatableParameterOnlyAttributeSingleClass()->fooClass(), '__construct', 'baz', objectType(RepeatableParameterOnly::class)
    );

it('contains first target reflection and attribute instance')
    ->containsTargetMethodParameterAndAttributeInstance(
        Fixtures::repeatableParameterOnlyAttributeSingleClass()->fooClass(), '__construct', 'baz', objectType(RepeatableParameterOnly::class),
        fn(RepeatableParameterOnly $parameterOnly) => $parameterOnly->value === 'foo'
    );

it('contains second target reflection and attribute instance')
    ->containsTargetMethodParameterAndAttributeInstance(
        Fixtures::repeatableParameterOnlyAttributeSingleClass()->fooClass(), '__construct', 'baz', objectType(RepeatableParameterOnly::class),
        fn(RepeatableParameterOnly $parameterOnly) => $parameterOnly->value === 'bar'
    );
