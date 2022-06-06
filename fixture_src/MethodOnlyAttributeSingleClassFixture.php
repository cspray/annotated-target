<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

final class MethodOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/MethodOnlyAttributeSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(MethodOnlyAttributeSingleClass\FooClass::class);
    }
}