<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

class ParameterOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/ParameterOnlyAttributeSingleClass';
    }

    public function fooClass() : string {
        return ParameterOnlyAttributeSingleClass\FooClass::class;
    }
}