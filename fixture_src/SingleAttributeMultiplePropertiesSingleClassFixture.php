<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

final class SingleAttributeMultiplePropertiesSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/SingleAttributeMultiplePropertiesSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(SingleAttributeMultiplePropertiesSingleClass\FooClass::class);
    }

}