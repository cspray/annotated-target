<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

#[\Attribute(\Attribute::TARGET_CLASS_CONSTANT)]
final class ConstantOnly {

    public function __construct(public readonly string $value) {}

}