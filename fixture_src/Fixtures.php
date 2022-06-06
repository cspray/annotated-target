<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

final class Fixtures {

    private function __construct() {}

    public static function classOnlyAttributeSingleClass() : ClassOnlyAttributeSingleClassFixture {
        return new ClassOnlyAttributeSingleClassFixture();
    }

    public static function repeatableClassOnlyAttributeSingleClass() : RepeatableClassOnlyAttributeSingleFixture {
        return new RepeatableClassOnlyAttributeSingleFixture();
    }

    public static function multipleDifferentClassOnlyAttributeSingleClass() : MultipleDifferentClassOnlyAttributeSingleClassFixture {
        return new MultipleDifferentClassOnlyAttributeSingleClassFixture();
    }

    public static function propertyOnlyAttributeSingleClass() : PropertyOnlyAttributeSingleClassFixture {
        return new PropertyOnlyAttributeSingleClassFixture();
    }

    public static function singleAttributeMultiplePropertiesSingleClass() : SingleAttributeMultiplePropertiesSingleClassFixture {
        return new SingleAttributeMultiplePropertiesSingleClassFixture();
    }

}