<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Unit\AnnotatedTargetParserTestCase;
use Cspray\AnnotatedTargetFixture\ConstantOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::constantOnlyAttributeGroupSingleClass());

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

it('contains target reflection class constant')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassConstant(
        Fixtures::constantOnlyAttributeGroupSingleClass()->fooClass(), 'BAR'
    );

it('contains target reflection class constant with attribute')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassConstantWithAttribute(
        Fixtures::constantOnlyAttributeGroupSingleClass()->fooClass(), 'BAR', objectType(ConstantOnly::class)
    );

it('contains target reflection class constant with attribute instance')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassConstantWithAttributeInstance(
        Fixtures::constantOnlyAttributeGroupSingleClass()->fooClass(), 'BAR', objectType(ConstantOnly::class),
        fn(ConstantOnly $constantOnly) => $constantOnly->value === 'getting the constant'
    );