<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixture;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\RepeatableConstantOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::repeatableConstantOnlyAttributeSingleClass());

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

it('contains target reflection class constant')
    ->expect($targets)
    ->toContainTargetClassConstant(
        Fixtures::repeatableConstantOnlyAttributeSingleClass()->fooClass(), 'FOO_BAR'
    );

it('contains target reflection class constant with attribute')
    ->expect($targets)
    ->toContainTargetClassConstantWithAttribute(
        Fixtures::repeatableConstantOnlyAttributeSingleClass()->fooClass(), 'FOO_BAR', objectType(RepeatableConstantOnly::class)
    );

it('contains target reflection class constant with first attribute instance')
    ->expect($targets)
    ->toContainTargetClassConstantWithAttributeInstance(
        Fixtures::repeatableConstantOnlyAttributeSingleClass()->fooClass(), 'FOO_BAR', objectType(RepeatableConstantOnly::class),
        fn(RepeatableConstantOnly $constantOnly) => $constantOnly->value === 'one'
    );

it('contains target reflection class constant with second attribute instance')
    ->expect($targets)
    ->toContainTargetClassConstantWithAttributeInstance(
        Fixtures::repeatableConstantOnlyAttributeSingleClass()->fooClass(), 'FOO_BAR', objectType(RepeatableConstantOnly::class),
        fn(RepeatableConstantOnly $constantOnly) => $constantOnly->value === 'two'
    );
