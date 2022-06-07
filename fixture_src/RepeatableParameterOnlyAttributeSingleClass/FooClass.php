<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\RepeatableParameterOnlyAttributeSingleClass;

use Cspray\AnnotatedTargetFixture\RepeatableParameterOnly;

class FooClass {

    public function __construct(
        #[RepeatableParameterOnly('foo'), RepeatableParameterOnly('bar')] string $baz
    ) {}

}