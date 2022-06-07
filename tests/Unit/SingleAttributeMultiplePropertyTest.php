<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\PropertyOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::singleAttributeMultiplePropertiesSingleClass());

$targets = fn() => $this->getTargets();

it('counts targets for multiple properties')
    ->expect($targets)
    ->toHaveCount(3);

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

it('includes target reflection property for first prop')
    ->expect($targets)
    ->toContainTargetProperty(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(),'foo'
    );

it('includes target reflection property for second prop')
    ->expect($targets)
    ->toContainTargetProperty(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'bar'
    );

it('includes target reflection property for third prop')
    ->expect($targets)
    ->toContainTargetProperty(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'baz'
    );

it('includes attribute reflection class for first prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttribute(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'foo', objectType(PropertyOnly::class)
    );

it('includes attribute reflection class for second prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttribute(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'bar', objectType(PropertyOnly::class)
    );

it('includes attribute reflection class for third prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttribute(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'baz', objectType(PropertyOnly::class)
    );

it('includes attribute instance value for first prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'foo', objectType(PropertyOnly::class),
        fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'foo-bar-baz'
    );

it('includes attribute instance value for second prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'bar', objectType(PropertyOnly::class),
        fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'foo-bar-baz'
    );

it('includes attribute instance value for third prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'baz', objectType(PropertyOnly::class),
        fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'foo-bar-baz'
    );
