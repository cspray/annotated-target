<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

final class RepeatableParameterOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/RepeatableParameterOnlyAttributeSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(RepeatableParameterOnlyAttributeSingleClass\FooClass::class);
    }
}