<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\PropertyOnly;

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
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'foo', PropertyOnly::class
    );

it('includes attribute reflection class for second prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttribute(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'bar', PropertyOnly::class
    );

it('includes attribute reflection class for third prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttribute(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'baz', PropertyOnly::class
    );

it('includes attribute instance value for first prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'foo', PropertyOnly::class,
        static fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'foo-bar-baz'
    );

it('includes attribute instance value for second prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'bar', PropertyOnly::class,
        static fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'foo-bar-baz'
    );

it('includes attribute instance value for third prop')
    ->expect($targets)
    ->toContainTargetPropertyWithAttributeInstance(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'baz', PropertyOnly::class,
        static fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'foo-bar-baz'
    );
