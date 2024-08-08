<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::classOnlyAttributeSingleInterface());

it('counts parsed targets for single class')
    ->expect(fn() => $this->getTargets())
    ->toHaveCount(1);

it('ensures all targets are correct type')
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

it('includes target reflection class')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClass(Fixtures::classOnlyAttributeSingleInterface()->fooInterface());

it('includes attribute reflection class')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassWithAttribute(Fixtures::classOnlyAttributeSingleInterface()->fooInterface(), ClassOnly::class);

it('includes attribute instance with correct value')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::classOnlyAttributeSingleInterface()->fooInterface(),
        ClassOnly::class,
        static fn(ClassOnly $classOnly) => $classOnly->value === 'foo'
    );