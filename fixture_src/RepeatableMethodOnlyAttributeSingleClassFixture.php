<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

class RepeatableMethodOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ .'/RepeatableMethodOnlyAttributeSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(RepeatableMethodOnlyAttributeSingleClass\FooClass::class);
    }
}