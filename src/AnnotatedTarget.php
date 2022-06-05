<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use ReflectionAttribute;
use ReflectionClass;

interface AnnotatedTarget {

    public function getTargetReflection() : ReflectionClass;

    public function getAttributeReflection() : ReflectionAttribute;

    public function getAttributeInstance() : object;

}