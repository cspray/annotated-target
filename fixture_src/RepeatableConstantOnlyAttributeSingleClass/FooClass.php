<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\RepeatableConstantOnlyAttributeSingleClass;

use Cspray\AnnotatedTargetFixture\RepeatableConstantOnly;

class FooClass {

    #[RepeatableConstantOnly('one'), RepeatableConstantOnly('two')]
    public const FOO_BAR = 'baz';

}