<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::IS_REPEATABLE)]
class RepeatableFunctionOnly {

    public function __construct(public readonly string $value) {}

}