<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionProperty;

interface AnnotatedTarget {

    public function getTargetReflection() : ReflectionClass|ReflectionProperty|ReflectionClassConstant;

    public function getAttributeReflection() : ReflectionAttribute;

    public function getAttributeInstance() : object;

}