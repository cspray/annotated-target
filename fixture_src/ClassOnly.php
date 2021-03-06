<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class ClassOnly {

    public function __construct(
        public readonly string $value
    ) {}

}