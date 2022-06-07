<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

class NonPhpFileFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ . '/NonPhpFile';
    }

    public function fooClass() : ObjectType {
        return objectType(NonPhpFile\FooClass::class);
    }
}