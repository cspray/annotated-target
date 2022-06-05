<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Unit\AnnotatedTargetParserTestCase;
use Cspray\AnnotatedTargetFixture\ClassOnlyFixtures;
use ReflectionClass;

uses(AnnotatedTargetParserTestCase::class);

it('counts parsed targets for single class')
    ->withFixture(ClassOnlyFixtures::singleClass())
    ->assertTargetCount(1);

it('ensures all targets are correct type')
    ->withFixture(ClassOnlyFixtures::singleClass())
    ->assertTargetTypes();

it('includes target reflection class')
    ->withFixture(ClassOnlyFixtures::singleClass())
    ->assertIncludesTargetReflectionClass(new ReflectionClass(ClassOnlyFixtures::singleClass()->fooClass()->getName()));