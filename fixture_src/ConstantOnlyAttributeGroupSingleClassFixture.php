<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

final class ConstantOnlyAttributeGroupSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/ConstantOnlyAttributeGroupSingleClass';
    }

    public function fooClass() : ObjectType {
        return objectType(ConstantOnlyAttributeGroupSingleClass\FooClass::class);
    }

}