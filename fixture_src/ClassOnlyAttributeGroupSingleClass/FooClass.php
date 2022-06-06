<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\ClassOnlyAttributeGroupSingleClass;

use Cspray\AnnotatedTargetFixture\ClassOnly;
use Cspray\AnnotatedTargetFixture\RepeatableClassOnly;
use Cspray\AnnotatedTargetFixture\RepeatablePropertyOnly;

#[ClassOnly('baz')]
#[RepeatableClassOnly('foo'), RepeatableClassOnly('bar')]
#[RepeatableClassOnly('qux')]
class FooClass {}