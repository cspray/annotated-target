<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

final class MultipleDifferentClassOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/MultipleDifferentClassOnlyAttributeSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(MultipleDifferentClassOnlyAttributeSingleClass\FooClass::class);
    }
}