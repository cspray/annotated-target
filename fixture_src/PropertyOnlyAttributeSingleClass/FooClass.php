<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\PropertyOnlyAttributeSingleClass;

use Cspray\AnnotatedTargetFixture\PropertyOnly;

class FooClass {

    #[PropertyOnly('nick')]
    private string $prop;

}