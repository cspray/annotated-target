<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use phpDocumentor\Reflection\Types\Object_;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::nonPhpFile());

it('counts targets for single class')->assertTargetCount(1);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('contains target class')
    ->containsTargetClass(Fixtures::nonPhpFile()->fooClass());

it('contains target class and attribute')
    ->containsTargetClassAndAttribute(Fixtures::nonPhpFile()->fooClass(), objectType(ClassOnly::class));

it('contains target class and attribute instance')
    ->containsTargetClassAndAttributeInstance(
        Fixtures::nonPhpFile()->fooClass(), objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'the one'
    );