<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTarget\Unit\AnnotatedTargetParserTestCase;
use Cspray\AnnotatedTargetFixture\Fixtures;

uses(AnnotatedTargetParserTestCase::class);

it('counts targets for single class')
    ->withFixture(Fixtures::repeatableClassOnlyAttributeSingleClass())
    ->assertTargetCount(3);