<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Unit\AnnotatedTargetParserTestCase;
use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

it('counts parsed targets for single class')
    ->withFixture(Fixtures::classOnlyAttributeSingleClass())
    ->assertTargetCount(1);

it('ensures all targets are correct type')
    ->withFixture(Fixtures::classOnlyAttributeSingleClass())
    ->assertTargetTypes();

it('includes target reflection class')
    ->withFixture(Fixtures::classOnlyAttributeSingleClass())
    ->assertContainsTargetReflectionClassType(Fixtures::classOnlyAttributeSingleClass()->fooClass());

it('includes attribute reflection class')
    ->withFixture(Fixtures::classOnlyAttributeSingleClass())
    ->assertContainsTargetReflectionClassTypeAndReflectionAttributeType(Fixtures::classOnlyAttributeSingleClass()->fooClass(), objectType(ClassOnly::class));

it('includes attribute instance with correct value')
    ->withFixture(Fixtures::classOnlyAttributeSingleClass())
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::classOnlyAttributeSingleClass()->fooClass(),
        objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'single-class-foobar'
    );