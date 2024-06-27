<?php

namespace Cspray\AnnotatedTargetFixture;

use Cspray\AnnotatedTargetFixture\TargetAttributeInterface\TargetClass;

final class TargetAttributeInterfaceFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/TargetAttributeInterface';
    }

    public function targetClass() : string {
        return TargetClass::class;
    }
}