<?php declare(strict_types=1);

namespace Cspray\AnnotatedTargetFixture;

use Cspray\Typiphy\ObjectType;
use function Cspray\Typiphy\objectType;

class ClassOnlyAttributeSingleInterfaceFixture implements Fixture {

    public function getPath() : string {
        return __DIR__ .'/ClassOnlyAttributeSingleInterface';
    }

    public function fooInterface() : string {
        return ClassOnlyAttributeSingleInterface\FooInterface::class;
    }
}