<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\RepeatablePropertyOnlyAttributeSingleClass;

use Cspray\AnnotatedTargetFixture\RepeatablePropertyOnly;

class FooClass {

    #[RepeatablePropertyOnly('Archer')]
    #[RepeatablePropertyOnly('Lana')]
    #[RepeatablePropertyOnly('Ray')]
    protected $something;

}