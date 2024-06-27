<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

final class RepeatableParameterOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/RepeatableParameterOnlyAttributeSingleClass';
    }

    public function fooClass() : string {
        return RepeatableParameterOnlyAttributeSingleClass\FooClass::class;
    }
}