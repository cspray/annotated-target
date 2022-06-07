<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

use Cspray\AnnotatedTarget\AnnotatedTarget;
use Cspray\Typiphy\ObjectType;
use PHPUnit\Framework\Assert;

$checkTargetReflectionClass = function(AnnotatedTarget $target, ObjectType $expectedClass) : bool {
    return $target->getTargetReflection() instanceof ReflectionClass &&
        $target->getTargetReflection()->getName() === $expectedClass->getName();
};

$checkTargetReflectionClassConstant = function(AnnotatedTarget $target, ObjectType $expectedClass, string $expectedConst) : bool {
    return $target->getTargetReflection() instanceof ReflectionClassConstant &&
        $target->getTargetReflection()->getDeclaringClass()->getName() === $expectedClass->getName() &&
        $target->getTargetReflection()->getName() === $expectedConst;
};

$checkTargetReflectionFunction = function(AnnotatedTarget $target, string $expectedFunction) : bool {
    return $target->getTargetReflection() instanceof ReflectionFunction &&
        $target->getTargetReflection()->getName() === $expectedFunction;
};

$checkTargetReflectionFunctionParameter = function(AnnotatedTarget $target, string $expectedFunction, string $expectedParam) : bool {
    return $target->getTargetReflection() instanceof ReflectionParameter &&
        $target->getTargetReflection()->getDeclaringFunction()->getName() === $expectedFunction &&
        $target->getTargetReflection()->getName() === $expectedParam;
};

$checkTargetReflectionMethod = function(AnnotatedTarget $target, ObjectType $expectedClass, string $expectedMethod) : bool {
    return $target->getTargetReflection() instanceof ReflectionMethod &&
        $target->getTargetReflection()->getDeclaringClass()->getName() === $expectedClass->getName() &&
        $target->getTargetReflection()->getName() === $expectedMethod;
};

$checkTargetReflectionProperty = function(AnnotatedTarget $target, ObjectType $expectedClass, string $expectedProp) : bool {
    return $target->getTargetReflection() instanceof ReflectionProperty &&
        $target->getTargetReflection()->getDeclaringClass()->getName() === $expectedClass->getName() &&
        $target->getTargetReflection()->getName() === $expectedProp;
};

$checkTargetReflectionMethodParameter = function(AnnotatedTarget $target, ObjectType $expectedClass, string $expectedMethod, string $expectedParam) : bool {
    return $target->getTargetReflection() instanceof ReflectionParameter &&
        $target->getTargetReflection()->getDeclaringClass()->getName() === $expectedClass->getName() &&
        $target->getTargetReflection()->getDeclaringFunction()->getName() === $expectedMethod &&
        $target->getTargetReflection()->getName() === $expectedParam;
};

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

expect()->extend('toContainOnlyAnnotatedTargets', function() {
    return $this->each->toBeInstanceOf(AnnotatedTarget::class);
});

expect()->extend('toShareTargetReflection', function() {
    return $this->each(function($expectation) {
        expect($expectation->value->getTargetReflection())->toBe($expectation->value->getTargetReflection());
    });
});

expect()->extend('toShareAttributeReflection', function() {
    return $this->each(function($expectation) {
        expect($expectation->value->getAttributeReflection())->toBe($expectation->value->getAttributeReflection());
    });
});

expect()->extend('toShareAttributeInstance', function() {
    return $this->each(function($expectation) {
        expect($expectation->value->getAttributeInstance())->toBe($expectation->value->getAttributeInstance());
    });
});

expect()->extend('toContainTargetClass', function(ObjectType $expectedClass) use($checkTargetReflectionClass) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClass($item, $expectedClass)
    );
});

expect()->extend('toContainTargetClassWithAttribute', function(ObjectType $expectedClass, ObjectType $expectedAttribute) use($checkTargetReflectionClass) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClass($item, $expectedClass) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName()
    );
});

expect()->extend('toContainTargetClassWithAttributeInstance', function(ObjectType $expectedClass, ObjectType $expectedAttribute, callable $callable) use($checkTargetReflectionClass) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClass($item, $expectedClass) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName() &&
            $callable($item->getAttributeInstance())
    );
});

expect()->extend('toContainTargetClassConstant', function(ObjectType $expectedClass, string $expectedConst) use($checkTargetReflectionClassConstant)  {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClassConstant($item, $expectedClass, $expectedConst)
    );
});

expect()->extend('toContainTargetClassConstantWithAttribute', function(ObjectType $expectedClass, string $expectedConst, ObjectType $expectedAttribute) use($checkTargetReflectionClassConstant) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClassConstant($item, $expectedClass, $expectedConst) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName()
    );
});

expect()->extend('toContainTargetClassConstantWithAttributeInstance', function(ObjectType $expectedClass, string $expectedConst, ObjectType $expectedAttribute, callable $callable) use($checkTargetReflectionClassConstant) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClassConstant($item, $expectedClass, $expectedConst) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName() &&
            $callable($item->getAttributeInstance())
    );
});

expect()->extend('toContainTargetFunction', function(string $expectedFunction) use($checkTargetReflectionFunction) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunction($item, $expectedFunction)
    );
});

expect()->extend('toContainTargetFunctionWithAttribute', function(string $expectedFunction, ObjectType $expectedAttribute) use($checkTargetReflectionFunction) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunction($item, $expectedFunction) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName()
    );
});

expect()->extend('toContainTargetFunctionWithAttributeInstance', function(string $expectedFunction, ObjectType $expectedAttribute, callable $callable) use($checkTargetReflectionFunction) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunction($item, $expectedFunction) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName() &&
            $callable($item->getAttributeInstance())
    );
});

expect()->extend('toContainTargetFunctionParameter', function(string $expectedFunction, string $expectedParam) use($checkTargetReflectionFunctionParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunctionParameter($item, $expectedFunction, $expectedParam)
    );
});

expect()->extend('toContainTargetFunctionParameterWithAttribute', function(string $expectedFunction, string $expectedParam, ObjectType $expectedAttribute) use($checkTargetReflectionFunctionParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunctionParameter($item, $expectedFunction, $expectedParam) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName()
    );
});

expect()->extend('toContainTargetFunctionParameterWithAttributeInstance', function(string $expectedFunction, string $expectedParam, ObjectType $expectedAttribute, callable $callable) use($checkTargetReflectionFunctionParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunctionParameter($item, $expectedFunction, $expectedParam) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName() &&
            $callable($item->getAttributeInstance())
    );
});

expect()->extend('toContainTargetMethod', function(ObjectType $expectedClass, string $expectedMethod) use($checkTargetReflectionMethod) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethod($item, $expectedClass, $expectedMethod)
    );
});

expect()->extend('toContainTargetMethodWithAttribute', function(ObjectType $expectedClass, string $expectedMethod, ObjectType $expectedAttribute) use($checkTargetReflectionMethod) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethod($item, $expectedClass, $expectedMethod) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName()
    );
});

expect()->extend('toContainTargetMethodWithAttributeInstance', function(ObjectType $expectedClass, string $expectedMethod, ObjectType $expectedAttribute, callable $callable) use($checkTargetReflectionMethod) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethod($item, $expectedClass, $expectedMethod) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName() &&
            $callable($item->getAttributeInstance())
    );
});

expect()->extend('toContainTargetProperty', function(ObjectType $expectedClass, string $expectedProp) use($checkTargetReflectionProperty) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionProperty($item, $expectedClass, $expectedProp)
    );
});

expect()->extend('toContainTargetPropertyWithAttribute', function(ObjectType $expectedClass, string $expectedProp, ObjectType $expectedAttribute) use($checkTargetReflectionProperty) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionProperty($item, $expectedClass, $expectedProp) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName()
    );
});

expect()->extend('toContainTargetPropertyWithAttributeInstance', function(ObjectType $expectedClass, string $expectedProp, ObjectType $expectedAttribute, callable $callable) use($checkTargetReflectionProperty) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionProperty($item, $expectedClass, $expectedProp) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName() &&
            $callable($item->getAttributeInstance())
    );
});

expect()->extend('toContainTargetMethodParameter', function(ObjectType $expectedClass, string $expectedMethod, string $expectedParam) use($checkTargetReflectionMethodParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethodParameter($item, $expectedClass, $expectedMethod, $expectedParam)
    );
});

expect()->extend('toContainTargetMethodParameterWithAttribute', function(ObjectType $expectedClass, string $expectedMethod, string $expectedParam, ObjectType $expectedAttribute) use($checkTargetReflectionMethodParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethodParameter($item, $expectedClass, $expectedMethod, $expectedParam) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName()
    );
});

expect()->extend('toContainTargetMethodParameterWithAttributeInstance', function(ObjectType $expectedClass, string $expectedMethod, string $expectedParam, ObjectType $expectedAttribute, callable $callable) use($checkTargetReflectionMethodParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethodParameter($item, $expectedClass, $expectedMethod, $expectedParam) &&
            $item->getAttributeReflection()->getName() === $expectedAttribute->getName() &&
            $callable($item->getAttributeInstance())
    );
});

expect()->extend('toContainAny', function(callable $callable, string $message = null) {
    if (!is_iterable($this->value)) {
        throw new BadMethodCallException('Expectation value is not iterable.');
    }

    $contains = false;
    foreach ($this->value as $item) {
        if ($callable($item)) {
            $contains = true;
            break;
        }
    }

    if (!$contains) {
        Assert::fail($message ?? 'Failed asserting that any item in expected iterable passes callable.');
    }

    // We need to increment the Assert count to pass PHPUnit's assert count check
    Assert::assertTrue(true);
    return $this;
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/
