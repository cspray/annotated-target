<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

class RepeatableMethodOnlyAttributeSingleClassFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ .'/RepeatableMethodOnlyAttributeSingleClass';
    }

    public function fooClass() : string {
        return RepeatableMethodOnlyAttributeSingleClass\FooClass::class;
    }
}