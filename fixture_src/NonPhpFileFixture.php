<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

class NonPhpFileFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/NonPhpFile';
    }

    public function fooClass() : string {
        return NonPhpFile\FooClass::class;
    }
}
