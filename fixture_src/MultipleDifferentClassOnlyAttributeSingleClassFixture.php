<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

final class MultipleDifferentClassOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/MultipleDifferentClassOnlyAttributeSingleClass';
    }

    public function fooClass() : string {
        return MultipleDifferentClassOnlyAttributeSingleClass\FooClass::class;
    }
}