<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Generator;
use ReflectionAttribute;
use ReflectionClass;

final class PhpParserAnnotatedTargetParser implements AnnotatedTargetParser {

    public function parse(AnnotatedTargetParserOptions $options) : Generator {
        yield new class implements AnnotatedTarget {

            public function getTargetReflection() : ReflectionClass {
                // TODO: Implement getTargetReflection() method.
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