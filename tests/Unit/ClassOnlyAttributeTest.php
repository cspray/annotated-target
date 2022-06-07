<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::classOnlyAttributeSingleClass());

it('counts parsed targets for single class')->assertTargetCount(1);

it('ensures all targets are correct type')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('includes target reflection class')
    ->containsTargetClass(Fixtures::classOnlyAttributeSingleClass()->fooClass());

it('includes attribute reflection class')
    ->containsTargetClassAndAttribute(Fixtures::classOnlyAttributeSingleClass()->fooClass(), objectType(ClassOnly::class));

it('includes attribute instance with correct value')
    ->containsTargetClassAndAttributeInstance(
        Fixtures::classOnlyAttributeSingleClass()->fooClass(),
        objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'single-class-foobar'
    );