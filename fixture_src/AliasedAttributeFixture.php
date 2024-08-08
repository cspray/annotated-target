<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

final class AliasedAttributeFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/AliasedAttribute';
    }

    public function fooClass() : string {
        return AliasedAttribute\FooClass::class;
    }
}