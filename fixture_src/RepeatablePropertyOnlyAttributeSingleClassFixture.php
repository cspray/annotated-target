<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

class RepeatablePropertyOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/RepeatablePropertyOnlyAttributeSingleClass';
    }

    public function fooClass() : string {
        return RepeatablePropertyOnlyAttributeSingleClass\FooClass::class;
    }
}