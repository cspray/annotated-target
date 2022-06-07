<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class PropertyOnly {

    public function __construct(public readonly string $value) {}

}