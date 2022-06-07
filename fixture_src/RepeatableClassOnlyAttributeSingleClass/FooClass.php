<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\RepeatableClassOnlyAttributeSingleClass;

use Cspray\AnnotatedTargetFixture\RepeatableClassOnly;

#[RepeatableClassOnly('foo')]
#[RepeatableClassOnly('bar')]
#[RepeatableClassOnly('baz')]
class FooClass {

}