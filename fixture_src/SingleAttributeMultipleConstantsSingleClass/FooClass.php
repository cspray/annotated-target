<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\SingleAttributeMultipleConstantsSingleClass;

use Cspray\AnnotatedTargetFixture\ConstantOnly;

class FooClass {

    #[ConstantOnly('Mallory')]
    const FOO = 'qux', BAR = 'baz';

}