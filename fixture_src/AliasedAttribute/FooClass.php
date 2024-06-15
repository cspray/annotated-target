<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\AliasedAttribute;

use Cspray\AnnotatedTargetFixture\ClassOnly as MyAttributeName;

#[MyAttributeName('my aliased value')]
class FooClass {

}