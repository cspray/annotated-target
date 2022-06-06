<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\ParameterOnlyAttributeSingleClass;

use Cspray\AnnotatedTargetFixture\ParameterOnly;

class FooClass {

    public function myMethod(#[ParameterOnly('myParamValue')] string $myParam) : void {}

}