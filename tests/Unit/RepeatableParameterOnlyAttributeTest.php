<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatableParameterOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::repeatableParameterOnlyAttributeSingleClass());

$targets = fn() => $this->getTargets();

it('counts targets for single parameter')
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

it('contains target reflection parameter')
    ->expect($targets)
    ->toContainTargetMethodParameter(
        Fixtures::repeatableParameterOnlyAttributeSingleClass()->fooClass(), '__construct', 'baz'
    );

it('contains target reflection and attribute')
    ->expect($targets)
    ->toContainTargetMethodParameterWithAttribute(
        Fixtures::repeatableParameterOnlyAttributeSingleClass()->fooClass(), '__construct', 'baz', objectType(RepeatableParameterOnly::class)
    );

it('contains first target reflection and attribute instance')
    ->expect($targets)
    ->toContainTargetMethodParameterWithAttributeInstance(
        Fixtures::repeatableParameterOnlyAttributeSingleClass()->fooClass(), '__construct', 'baz', objectType(RepeatableParameterOnly::class),
        fn(RepeatableParameterOnly $parameterOnly) => $parameterOnly->value === 'foo'
    );

it('contains second target reflection and attribute instance')
    ->expect($targets)
    ->toContainTargetMethodParameterWithAttributeInstance(
        Fixtures::repeatableParameterOnlyAttributeSingleClass()->fooClass(), '__construct', 'baz', objectType(RepeatableParameterOnly::class),
        fn(RepeatableParameterOnly $parameterOnly) => $parameterOnly->value === 'bar'
    );
