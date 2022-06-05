<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\AnnotatedTargetFixture\ClassOnlyFixtures;
use Generator;
use ReflectionAttribute;
use ReflectionClass;

final class PhpParserAnnotatedTargetParser implements AnnotatedTargetParser {

    public function parse(AnnotatedTargetParserOptions $options) : Generator {
        yield new class implements AnnotatedTarget {

            public function getTargetReflection() : ReflectionClass {
                return new ReflectionClass(ClassOnlyFixtures::singleClass()->fooClass()->getName());
            }

            public function getAttributeReflection() : ReflectionAttribute {
                // TODO: Implement getAttributeReflection() method.
            }

            public function getAttributeInstance() : object {
                // TODO: Implement getAttributeInstance() method.
            }
        };
    }

}