<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\FunctionParameterOnlyAttributeSingleFunction;

use Cspray\AnnotatedTargetFixture\ParameterOnly;

function withParam(
    #[ParameterOnly('awesome')] string $param
) : void {}