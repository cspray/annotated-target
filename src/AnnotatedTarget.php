<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;
use ReflectionProperty;

interface AnnotatedTarget {

    public function targetReflection() : ReflectionClass|ReflectionProperty|ReflectionClassConstant|ReflectionMethod|ReflectionParameter|ReflectionFunction;

    public function attributeReflection() : ReflectionAttribute;

    public function attributeInstance() : object;

}