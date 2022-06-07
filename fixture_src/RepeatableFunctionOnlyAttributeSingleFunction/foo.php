<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\RepeatableFunctionOnlyAttributeSingleFunction;

use Cspray\AnnotatedTargetFixture\RepeatableFunctionOnly;

#[RepeatableFunctionOnly('nick'), RepeatableFunctionOnly('xoe')]
function repeatYes() : void {}