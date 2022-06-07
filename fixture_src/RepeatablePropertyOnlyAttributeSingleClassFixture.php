<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

class RepeatablePropertyOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/RepeatablePropertyOnlyAttributeSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(RepeatablePropertyOnlyAttributeSingleClass\FooClass::class);
    }
}