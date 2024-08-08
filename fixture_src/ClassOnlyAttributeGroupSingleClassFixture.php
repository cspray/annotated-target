<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

class ClassOnlyAttributeGroupSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/ClassOnlyAttributeGroupSingleClass';
    }

    public function fooClass() : string {
        return ClassOnlyAttributeGroupSingleClass\FooClass::class;
    }
}