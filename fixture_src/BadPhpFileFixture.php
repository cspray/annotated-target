<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

class BadPhpFileFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/InvalidPhpSyntax';
    }

}