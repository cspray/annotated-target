<?php

namespace Cspray\AnnotatedTargetFixture;

use Cspray\AnnotatedTargetFixture\TargetAttributeInterface\TargetClass;
use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

final class TargetAttributeInterfaceFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/TargetAttributeInterface';
    }

    public function targetClass() : ObjectType {
        return objectType(TargetClass::class);
    }
}