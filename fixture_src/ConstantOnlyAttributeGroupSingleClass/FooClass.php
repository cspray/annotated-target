<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\ConstantOnlyAttributeGroupSingleClass;

use Cspray\AnnotatedTargetFixture\ConstantOnly;

class FooClass {

    #[ConstantOnly('getting the constant')]
    private const BAR = 'baz';

}