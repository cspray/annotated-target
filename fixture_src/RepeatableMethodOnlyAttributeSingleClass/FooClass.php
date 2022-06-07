<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\RepeatableMethodOnlyAttributeSingleClass;

use Cspray\AnnotatedTargetFixture\MethodOnly;
use Cspray\AnnotatedTargetFixture\RepeatableMethodOnly;

class FooClass {

    #[MethodOnly('methodOnly')]
    #[RepeatableMethodOnly('repeatableMethodOnly')]
    public function theirMethod() : void {

    }

}