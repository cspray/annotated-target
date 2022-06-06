<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class RepeatableClassOnly {

    public function __construct(public readonly string $value) {}

}