<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

class SingleAttributeMultipleConstantsSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/SingleAttributeMultipleConstantsSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(SingleAttributeMultipleConstantsSingleClass\FooClass::class);
    }
}