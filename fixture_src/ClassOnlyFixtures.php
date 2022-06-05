<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

final class ClassOnlyFixtures {

    private function __construct() {}

    public static function singleClass() : ClassOnlyAttributeSingleClassFixture {
        return new ClassOnlyAttributeSingleClassFixture();
    }

}