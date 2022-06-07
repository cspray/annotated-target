<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(
    Fixtures::classOnlyAttributeSingleClass(),
    Fixtures::propertyOnlyAttributeSingleClass(),
    Fixtures::methodOnlyAttributeSingleClass()
)->withFilteredAttributes(objectType(ClassOnly::class));

$targets = fn() => $this->getTargets();

it('counts parsed targets for single class')
    ->expect($targets)
    ->toHaveCount(1);

it('ensures all targets are correct type')
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

it('includes target reflection class')
    ->expect($targets)
    ->toContainTargetClass(Fixtures::classOnlyAttributeSingleClass()->fooClass());

it('includes attribute reflection class')
    ->expect($targets)
    ->toContainTargetClassWithAttribute(Fixtures::classOnlyAttributeSingleClass()->fooClass(), objectType(ClassOnly::class));

it('includes attribute instance with correct value')
    ->expect($targets)
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::classOnlyAttributeSingleClass()->fooClass(),
        objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'single-class-foobar'
    );
