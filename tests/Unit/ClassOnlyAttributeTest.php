<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Unit\AnnotatedTargetParserTestCase;
use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\ClassOnlyFixtures;
use ReflectionClass;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

it('counts parsed targets for single class')
    ->withFixture(ClassOnlyFixtures::singleClass())
    ->assertTargetCount(1);

it('ensures all targets are correct type')
    ->withFixture(ClassOnlyFixtures::singleClass())
    ->assertTargetTypes();

it('includes target reflection class')
    ->withFixture(ClassOnlyFixtures::singleClass())
    ->assertContainsTargetReflectionClassType(ClassOnlyFixtures::singleClass()->fooClass());

it('includes attribute reflection class')
    ->withFixture(ClassOnlyFixtures::singleClass())
    ->assertContainsTargetReflectionClassTypeAndReflectionAttributeType(ClassOnlyFixtures::singleClass()->fooClass(), objectType(ClassOnly::class));

it('includes attribute instance with correct value')
    ->withFixture(ClassOnlyFixtures::singleClass())
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        ClassOnlyFixtures::singleClass()->fooClass(),
        objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'single-class-foobar'
    );