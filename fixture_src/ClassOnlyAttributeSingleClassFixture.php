<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

final class ClassOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/ClassOnlyAttributeSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(ClassOnlyAttributeSingleClass\FooClass::class);
    }
}