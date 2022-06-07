<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

final class FunctionParameterOnlyAttributeSingleFunctionFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/FunctionParameterOnlyAttributeSingleFunction';
    }

    public function fooFunction() : string {
        return 'Cspray\\AnnotatedTargetFixture\\FunctionParameterOnlyAttributeSingleFunction\\withParam';
    }
}