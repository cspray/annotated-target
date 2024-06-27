<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

class RepeatableConstantOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/RepeatableConstantOnlyAttributeSingleClass';
    }

    public function fooClass() : string {
        return RepeatableConstantOnlyAttributeSingleClass\FooClass::class;
    }
}