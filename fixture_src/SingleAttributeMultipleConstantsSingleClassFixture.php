<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

class SingleAttributeMultipleConstantsSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/SingleAttributeMultipleConstantsSingleClass';
    }

    public function fooClass() : string {
        return SingleAttributeMultipleConstantsSingleClass\FooClass::class;
    }
}