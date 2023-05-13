<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture\InvalidPhpSyntax;

class BadPhpFile {

    public function method() : string {
        return '':
    }

}