<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::classOnlyAttributeSingleClass());

it('counts parsed targets for single class')->assertTargetCount(1);

it('ensures all targets are correct type')->assertTargetTypes();

it('includes target reflection class')
    ->assertContainsTargetReflectionClassType(Fixtures::classOnlyAttributeSingleClass()->fooClass());

it('includes attribute reflection class')
    ->assertContainsTargetReflectionClassTypeAndReflectionAttributeType(Fixtures::classOnlyAttributeSingleClass()->fooClass(), objectType(ClassOnly::class));

it('includes attribute instance with correct value')
    ->assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        Fixtures::classOnlyAttributeSingleClass()->fooClass(),
        objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'single-class-foobar'
    );