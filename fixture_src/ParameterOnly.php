<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class ParameterOnly {

    public function __construct(public readonly string $value) {}

}