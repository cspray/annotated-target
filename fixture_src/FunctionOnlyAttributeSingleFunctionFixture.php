<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

class FunctionOnlyAttributeSingleFunctionFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/FunctionOnlyAttributeSingleFunction';
    }

    public function fooFunction() : string {
        return 'Cspray\\AnnotatedTargetFixture\\FunctionOnlyAttributeSingleFunction\\yes';
    }
}