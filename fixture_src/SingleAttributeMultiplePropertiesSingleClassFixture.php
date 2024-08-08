<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

final class SingleAttributeMultiplePropertiesSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/SingleAttributeMultiplePropertiesSingleClass';
    }

    public function fooClass() : string {
        return SingleAttributeMultiplePropertiesSingleClass\FooClass::class;
    }

}