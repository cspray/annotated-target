<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Unit\AnnotatedTargetParserTestCase;
use Cspray\AnnotatedTargetFixture\ConstantOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::constantOnlyAttributeGroupSingleClass());

it('counts targets for single constant')->assertTargetCount(1);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('contains target reflection class constant')
    ->containsTargetReflectionClassConstant(
        Fixtures::constantOnlyAttributeGroupSingleClass()->fooClass(), 'BAR'
    );

it('contains target reflection class constant with attribute')
    ->containsTargetReflectionClassConstantAndReflectionAttribute(
        Fixtures::constantOnlyAttributeGroupSingleClass()->fooClass(), 'BAR', objectType(ConstantOnly::class)
    );

it('contains target reflection class constant with attribute instance')
    ->containsReflectionClassConstantReflectionAttributeAndAttributeInstance(
        Fixtures::constantOnlyAttributeGroupSingleClass()->fooClass(), 'BAR', objectType(ConstantOnly::class),
        fn(ConstantOnly $constantOnly) => $constantOnly->value === 'getting the constant'
    );