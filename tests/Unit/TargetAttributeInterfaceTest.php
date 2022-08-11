<?php

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\TargetAttributeImplementation;
use Cspray\AnnotatedTargetFixture\TargetAttributeInterface;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::targetAttributeInterface())
    ->withFilteredAttributes(objectType(TargetAttributeInterface::class));

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
    ->toContainTargetClass(Fixtures::targetAttributeInterface()->targetClass());

it('includes attribute reflection class')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassWithAttribute(Fixtures::targetAttributeInterface()->targetClass(), objectType(TargetAttributeImplementation::class));

it('includes attribute instance with correct value')
    ->expect(fn() => $this->getTargets())
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::targetAttributeInterface()->targetClass(),
        objectType(TargetAttributeImplementation::class),
        fn(TargetAttributeImplementation $classOnly) => $classOnly->value === 'target-attr'
    );
