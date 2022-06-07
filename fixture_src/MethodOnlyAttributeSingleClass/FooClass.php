<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\MethodOnlyAttributeSingleClass;

use Cspray\AnnotatedTargetFixture\MethodOnly;

class FooClass {

    #[MethodOnly('is the coolest method')]
    public function myMethod() : void {

    }

}