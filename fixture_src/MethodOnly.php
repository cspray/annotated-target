<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
final class MethodOnly {

    public function __construct(public readonly string $value) {}

}