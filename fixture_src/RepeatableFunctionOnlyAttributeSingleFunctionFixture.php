<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

class RepeatableFunctionOnlyAttributeSingleFunctionFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/RepeatableFunctionOnlyAttributeSingleFunction';
    }

    public function fooFunction() : string {
        return 'Cspray\\AnnotatedTargetFixture\\RepeatableFunctionOnlyAttributeSingleFunction\\repeatYes';
    }
}