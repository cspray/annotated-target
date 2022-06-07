<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ConstantOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::singleAttributeMultipleConstantsSingleClass());

$targets = fn() => $this->getTargets();

it('counts targets for single constant')
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

it('contains first target reflection class constant')
    ->expect($targets)
    ->toContainTargetClassConstant(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'FOO'
    );

it('contains second target reflection class constant')
    ->expect($targets)
    ->toContainTargetClassConstant(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'BAR'
    );


it('contains first target reflection class constant with attribute')
    ->expect($targets)
    ->toContainTargetClassConstantWithAttribute(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'FOO', objectType(ConstantOnly::class)
    );

it('contains second target reflection class constant with attribute')
    ->expect($targets)
    ->toContainTargetClassConstantWithAttribute(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'BAR', objectType(ConstantOnly::class)
    );

it('contains first target reflection class constant with attribute instance')
    ->expect($targets)
    ->toContainTargetClassConstantWithAttributeInstance(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'FOO', objectType(ConstantOnly::class),
        fn(ConstantOnly $constantOnly) => $constantOnly->value === 'Mallory'
    );

it('contains second target reflection class constant with attribute instance')
    ->expect($targets)
    ->toContainTargetClassConstantWithAttributeInstance(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'BAR', objectType(ConstantOnly::class),
        fn(ConstantOnly $constantOnly) => $constantOnly->value === 'Mallory'
    );
