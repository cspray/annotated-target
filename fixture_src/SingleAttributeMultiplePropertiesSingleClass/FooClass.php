<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\SingleAttributeMultiplePropertiesSingleClass;

use Cspray\AnnotatedTargetFixture\PropertyOnly;

class FooClass {

    #[PropertyOnly('foo-bar-baz')]
    private string $foo, $bar, $baz;

}