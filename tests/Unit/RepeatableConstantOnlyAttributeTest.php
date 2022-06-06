<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixture;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatableConstantOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::repeatableConstantOnlyAttributeSingleClass());

it('counts targets for single constant')->assertTargetCount(2);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('contains target reflection class constant')
    ->containsTargetReflectionClassConstant(
        Fixtures::repeatableConstantOnlyAttributeSingleClass()->fooClass(), 'FOO_BAR'
    );

it('contains target reflection class constant with attribute')
    ->containsTargetReflectionClassConstantAndReflectionAttribute(
        Fixtures::repeatableConstantOnlyAttributeSingleClass()->fooClass(), 'FOO_BAR', objectType(RepeatableConstantOnly::class)
    );

it('contains target reflection class constant with first attribute instance')
    ->containsReflectionClassConstantReflectionAttributeAndAttributeInstance(
        Fixtures::repeatableConstantOnlyAttributeSingleClass()->fooClass(), 'FOO_BAR', objectType(RepeatableConstantOnly::class),
        fn(RepeatableConstantOnly $constantOnly) => $constantOnly->value === 'one'
    );

it('contains target reflection class constant with second attribute instance')
    ->containsReflectionClassConstantReflectionAttributeAndAttributeInstance(
        Fixtures::repeatableConstantOnlyAttributeSingleClass()->fooClass(), 'FOO_BAR', objectType(RepeatableConstantOnly::class),
        fn(RepeatableConstantOnly $constantOnly) => $constantOnly->value === 'two'
    );
