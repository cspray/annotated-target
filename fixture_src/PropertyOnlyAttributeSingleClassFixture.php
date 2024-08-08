<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

final class PropertyOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/PropertyOnlyAttributeSingleClass';
    }

    public function fooClass() : string {
        return PropertyOnlyAttributeSingleClass\FooClass::class;
    }
}