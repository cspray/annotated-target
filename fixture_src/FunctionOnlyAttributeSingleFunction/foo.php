<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\FunctionOnlyAttributeSingleFunction;

use Cspray\AnnotatedTargetFixture\FunctionOnly;

#[FunctionOnly('would a crazy person do this?')]
function yes() : void {

}
