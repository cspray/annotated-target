<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

class ClassOnlyAttributeGroupSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/ClassOnlyAttributeGroupSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(ClassOnlyAttributeGroupSingleClass\FooClass::class);
    }
}