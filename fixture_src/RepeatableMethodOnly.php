<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class RepeatableMethodOnly {

    public function __construct(public readonly string $value) {}

}