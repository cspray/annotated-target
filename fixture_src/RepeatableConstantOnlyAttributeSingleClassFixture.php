<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

class RepeatableConstantOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/RepeatableConstantOnlyAttributeSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(RepeatableConstantOnlyAttributeSingleClass\FooClass::class);
    }
}