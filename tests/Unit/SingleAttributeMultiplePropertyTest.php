<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\Fixtures;
use Cspray\AnnotatedTargetFixture\PropertyOnly;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::singleAttributeMultiplePropertiesSingleClass());

it('counts targets for multiple properties')->assertTargetCount(3);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('includes target reflection property for first prop')
    ->assertContainsTargetReflectionProperty(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(),'foo'
    );

it('includes target reflection property for second prop')
    ->assertContainsTargetReflectionProperty(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'bar'
    );

it('includes target reflection property for third prop')
    ->assertContainsTargetReflectionProperty(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'baz'
    );

it('includes attribute reflection class for first prop')
    ->assertContainsTargetReflectionPropertyAndReflectionAttribute(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'foo', objectType(PropertyOnly::class)
    );

it('includes attribute reflection class for second prop')
    ->assertContainsTargetReflectionPropertyAndReflectionAttribute(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'bar', objectType(PropertyOnly::class)
    );

it('includes attribute reflection class for third prop')
    ->assertContainsTargetReflectionPropertyAndReflectionAttribute(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'baz', objectType(PropertyOnly::class)
    );

it('includes attribute instance value for first prop')
    ->assertContainsTargetReflectionPropertyAndValidReflectionAttributeInstance(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'foo', objectType(PropertyOnly::class),
        fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'foo-bar-baz'
    );

it('includes attribute instance value for second prop')
    ->assertContainsTargetReflectionPropertyAndValidReflectionAttributeInstance(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'bar', objectType(PropertyOnly::class),
        fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'foo-bar-baz'
    );

it('includes attribute instance value for third prop')
    ->assertContainsTargetReflectionPropertyAndValidReflectionAttributeInstance(
        Fixtures::singleAttributeMultiplePropertiesSingleClass()->fooClass(), 'baz', objectType(PropertyOnly::class),
        fn(PropertyOnly $propertyOnly) => $propertyOnly->value === 'foo-bar-baz'
    );
