<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::nonPhpFile());

$targets = fn() => $this->getTargets();

it('counts targets for single class')
    ->expect($targets)
    ->toHaveCount(1);

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

it('contains target class')
    ->expect($targets)
    ->toContainTargetClass(Fixtures::nonPhpFile()->fooClass());

it('contains target class and attribute')
    ->expect($targets)
    ->toContainTargetClassWithAttribute(Fixtures::nonPhpFile()->fooClass(), objectType(ClassOnly::class));

it('contains target class and attribute instance')
    ->expect($targets)
    ->toContainTargetClassWithAttributeInstance(
        Fixtures::nonPhpFile()->fooClass(), objectType(ClassOnly::class),
        fn(ClassOnly $classOnly) => $classOnly->value === 'the one'
    );