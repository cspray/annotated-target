<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\PropertyOnly;
use function Cspray\AnnotatedTarget\parseAttributes;
use function Cspray\Typiphy\objectType;

$targets = fn() => iterator_to_array(parseAttributes([Fixtures::classOnlyAttributeSingleClass()->getPath(), Fixtures::propertyOnlyAttributeSingleClass()->getPath()]));

it('counts targets for single class')
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

it('contains class attribute target')
    ->expect($targets)
    ->toContainTargetClass(Fixtures::classOnlyAttributeSingleClass()->fooClass());

it('contains class attribute target and attribute')
    ->expect($targets)
    ->toContainTargetClassWithAttribute(Fixtures::classOnlyAttributeSingleClass()->fooClass(), objectType(ClassOnly::class));

it('contains class attribute target and attribute instance')
    ->expect($targets)
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::classOnlyAttributeSingleClass()->fooClass(), objectType(ClassOnly::class),
        fn($classOnly) => $classOnly instanceof ClassOnly && $classOnly->value === 'single-class-foobar'
    );

it('contains property attribute target')
    ->expect($targets)
    ->toContainTargetProperty(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop'
    );

it('contains property attribute target and attribute')
    ->expect($targets)
    ->toContainTargetPropertyWithAttribute(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop', objectType(PropertyOnly::class)
    );

it('contains property attribute target and attribute instance')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::propertyOnlyAttributeSingleClass()->fooClass(), 'prop', objectType(PropertyOnly::class),
        fn($propertyOnly) => $propertyOnly instanceof PropertyOnly && $propertyOnly->value === 'nick'
    );