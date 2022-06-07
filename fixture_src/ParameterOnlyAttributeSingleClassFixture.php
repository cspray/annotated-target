<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

class ParameterOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/ParameterOnlyAttributeSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(ParameterOnlyAttributeSingleClass\FooClass::class);
    }
}