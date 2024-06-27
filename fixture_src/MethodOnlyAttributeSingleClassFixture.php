<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

final class MethodOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/MethodOnlyAttributeSingleClass';
    }

    public function fooClass() : string {
        return MethodOnlyAttributeSingleClass\FooClass::class;
    }
}