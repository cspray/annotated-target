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

    public static function repeatablePropertyOnlyAttributeSingleClass() : RepeatablePropertyOnlyAttributeSingleClassFixture {
        return new RepeatablePropertyOnlyAttributeSingleClassFixture();
    }

    public static function classOnlyAttributeGroupSingleClass() : ClassOnlyAttributeGroupSingleClassFixture {
        return new ClassOnlyAttributeGroupSingleClassFixture();
    }

    public static function constantOnlyAttributeGroupSingleClass() : ConstantOnlyAttributeGroupSingleClassFixture {
        return new ConstantOnlyAttributeGroupSingleClassFixture();
    }

    public static function repeatableConstantOnlyAttributeSingleClass() : RepeatableConstantOnlyAttributeSingleClassFixture {
        return new RepeatableConstantOnlyAttributeSingleClassFixture();
    }

    public static function singleAttributeMultipleConstantsSingleClass() : SingleAttributeMultipleConstantsSingleClassFixture {
        return new SingleAttributeMultipleConstantsSingleClassFixture();
    }

    public static function methodOnlyAttributeSingleClass() : MethodOnlyAttributeSingleClassFixture {
        return new MethodOnlyAttributeSingleClassFixture();
    }

    public static function repeatableMethodOnlyAttributeSingleClass() : RepeatableMethodOnlyAttributeSingleClassFixture {
        return new RepeatableMethodOnlyAttributeSingleClassFixture();
    }

    public static function parameterOnlyAttributeSingleClass() : ParameterOnlyAttributeSingleClassFixture {
        return new ParameterOnlyAttributeSingleClassFixture();
    }

    public static function repeatableParameterOnlyAttributeSingleClass() : RepeatableParameterOnlyAttributeSingleClassFixture {
        return new RepeatableParameterOnlyAttributeSingleClassFixture();
    }

    public static function functionOnlyAttributeSingleFunction() : FunctionOnlyAttributeSingleFunctionFixture {
        return new FunctionOnlyAttributeSingleFunctionFixture();
    }

    public static function repeatableFunctionOnlyAttributeSingleFunction() : RepeatableFunctionOnlyAttributeSingleFunctionFixture {
        return new RepeatableFunctionOnlyAttributeSingleFunctionFixture();
    }

    public static function functionParameterOnlyAttributeSingleFunction() : FunctionParameterOnlyAttributeSingleFunctionFixture {
        return new FunctionParameterOnlyAttributeSingleFunctionFixture();
    }

    public static function nonPhpFile() : NonPhpFileFixture {
        return new NonPhpFileFixture();
    }

    public static function classOnlyAttributeSingleInterface() : ClassOnlyAttributeSingleInterfaceFixture {
        return new ClassOnlyAttributeSingleInterfaceFixture();
    }

    public static function targetAttributeInterface() : TargetAttributeInterfaceFixture {
        return new TargetAttributeInterfaceFixture();
    }

    public static function invalidSyntax() : BadPhpFileFixture {
        return new BadPhpFileFixture();
    }
}