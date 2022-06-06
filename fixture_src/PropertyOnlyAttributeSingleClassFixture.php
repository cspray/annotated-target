<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

final class PropertyOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/PropertyOnlyAttributeSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(PropertyOnlyAttributeSingleClass\FooClass::class);
    }
}