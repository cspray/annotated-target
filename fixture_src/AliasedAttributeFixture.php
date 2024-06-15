<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

final class AliasedAttributeFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/AliasedAttribute';
    }

    public function fooClass() : ObjectType {
        return objectType(AliasedAttribute\FooClass::class);
    }
}