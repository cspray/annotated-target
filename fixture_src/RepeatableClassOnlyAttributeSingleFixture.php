<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

final class RepeatableClassOnlyAttributeSingleFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/RepeatableClassOnlyAttributeSingleClass';
    }

    public function fooClass() : string {
        return RepeatableClassOnlyAttributeSingleClass\FooClass::class;
    }
}