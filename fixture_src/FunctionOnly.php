<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

#[\Attribute(\Attribute::TARGET_FUNCTION)]
final class FunctionOnly {

    public function __construct(public readonly string $value) {}

}