<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\MultipleDifferentClassOnlyAttributeSingleClass;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\RepeatableClassOnly;

#[ClassOnly('foo')]
#[RepeatableClassOnly('bar')]
#[RepeatableClassOnly('baz')]
class FooClass {}