<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

final class RepeatableClassOnlyAttributeSingleFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/RepeatableClassOnlyAttributeSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(RepeatableClassOnlyAttributeSingleClass\FooClass::class);
    }
}