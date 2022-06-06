<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;

interface AnnotatedTarget {

    public function getTargetReflection() : ReflectionClass|ReflectionProperty;

    public function getAttributeReflection() : ReflectionAttribute;

    public function getAttributeInstance() : object;

}