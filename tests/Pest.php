<?php

use Cspray\AnnotatedTarget\AnnotatedTarget;
use PHPUnit\Framework\Assert;

$checkTargetReflectionClass = function(AnnotatedTarget $target, string $expectedClass) : bool {
    return $target->targetReflection() instanceof ReflectionClass &&
        $target->targetReflection()->getName() === $expectedClass;
};

$checkTargetReflectionClassConstant = function(AnnotatedTarget $target, string $expectedClass, string $expectedConst) : bool {
    return $target->targetReflection() instanceof ReflectionClassConstant &&
        $target->targetReflection()->getDeclaringClass()->getName() === $expectedClass &&
        $target->targetReflection()->getName() === $expectedConst;
};

$checkTargetReflectionFunction = function(AnnotatedTarget $target, string $expectedFunction) : bool {
    return $target->targetReflection() instanceof ReflectionFunction &&
        $target->targetReflection()->getName() === $expectedFunction;
};

$checkTargetReflectionFunctionParameter = function(AnnotatedTarget $target, string $expectedFunction, string $expectedParam) : bool {
    return $target->targetReflection() instanceof ReflectionParameter &&
        $target->targetReflection()->getDeclaringFunction()->getName() === $expectedFunction &&
        $target->targetReflection()->getName() === $expectedParam;
};

$checkTargetReflectionMethod = function(AnnotatedTarget $target, string $expectedClass, string $expectedMethod) : bool {
    return $target->targetReflection() instanceof ReflectionMethod &&
        $target->targetReflection()->getDeclaringClass()->getName() === $expectedClass &&
        $target->targetReflection()->getName() === $expectedMethod;
};

$checkTargetReflectionProperty = function(AnnotatedTarget $target, string $expectedClass, string $expectedProp) : bool {
    return $target->targetReflection() instanceof ReflectionProperty &&
        $target->targetReflection()->getDeclaringClass()->getName() === $expectedClass &&
        $target->targetReflection()->getName() === $expectedProp;
};

$checkTargetReflectionMethodParameter = function(AnnotatedTarget $target, string $expectedClass, string $expectedMethod, string $expectedParam) : bool {
    return $target->targetReflection() instanceof ReflectionParameter &&
        $target->targetReflection()->getDeclaringClass()->getName() === $expectedClass &&
        $target->targetReflection()->getDeclaringFunction()->getName() === $expectedMethod &&
        $target->targetReflection()->getName() === $expectedParam;
};

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

expect()->extend('toContainOnlyAnnotatedTargets', function() {
    return $this->each->toBeInstanceOf(AnnotatedTarget::class);
});

expect()->extend('toShareTargetReflection', function() {
    return $this->each(function($expectation) {
        expect($expectation->value->targetReflection())->toBe($expectation->value->targetReflection());
    });
});

expect()->extend('toShareAttributeReflection', function() {
    return $this->each(function($expectation) {
        expect($expectation->value->attributeReflection())->toBe($expectation->value->attributeReflection());
    });
});

expect()->extend('toShareAttributeInstance', function() {
    return $this->each(function($expectation) {
        expect($expectation->value->attributeInstance())->toBe($expectation->value->attributeInstance());
    });
});

expect()->extend('toContainTargetClass', function(string $expectedClass) use($checkTargetReflectionClass) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClass($item, $expectedClass)
    );
});

expect()->extend('toContainTargetClassWithAttribute', function(string $expectedClass, string $expectedAttribute) use($checkTargetReflectionClass) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClass($item, $expectedClass) &&
            $item->attributeReflection()->getName() === $expectedAttribute
    );
});

expect()->extend('toContainTargetClassWithAttributeInstance', function(string $expectedClass, string $expectedAttribute, callable $callable) use($checkTargetReflectionClass) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClass($item, $expectedClass) &&
            $item->attributeReflection()->getName() === $expectedAttribute &&
            $callable($item->attributeInstance())
    );
});

expect()->extend('toContainTargetClassConstant', function(string $expectedClass, string $expectedConst) use($checkTargetReflectionClassConstant)  {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClassConstant($item, $expectedClass, $expectedConst)
    );
});

expect()->extend('toContainTargetClassConstantWithAttribute', function(string $expectedClass, string $expectedConst, string $expectedAttribute) use($checkTargetReflectionClassConstant) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClassConstant($item, $expectedClass, $expectedConst) &&
            $item->attributeReflection()->getName() === $expectedAttribute
    );
});

expect()->extend('toContainTargetClassConstantWithAttributeInstance', function(string $expectedClass, string $expectedConst, string $expectedAttribute, callable $callable) use($checkTargetReflectionClassConstant) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionClassConstant($item, $expectedClass, $expectedConst) &&
            $item->attributeReflection()->getName() === $expectedAttribute &&
            $callable($item->attributeInstance())
    );
});

expect()->extend('toContainTargetFunction', function(string $expectedFunction) use($checkTargetReflectionFunction) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunction($item, $expectedFunction)
    );
});

expect()->extend('toContainTargetFunctionWithAttribute', function(string $expectedFunction, string $expectedAttribute) use($checkTargetReflectionFunction) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunction($item, $expectedFunction) &&
            $item->attributeReflection()->getName() === $expectedAttribute
    );
});

expect()->extend('toContainTargetFunctionWithAttributeInstance', function(string $expectedFunction, string $expectedAttribute, callable $callable) use($checkTargetReflectionFunction) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunction($item, $expectedFunction) &&
            $item->attributeReflection()->getName() === $expectedAttribute &&
            $callable($item->attributeInstance())
    );
});

expect()->extend('toContainTargetFunctionParameter', function(string $expectedFunction, string $expectedParam) use($checkTargetReflectionFunctionParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunctionParameter($item, $expectedFunction, $expectedParam)
    );
});

expect()->extend('toContainTargetFunctionParameterWithAttribute', function(string $expectedFunction, string $expectedParam, string $expectedAttribute) use($checkTargetReflectionFunctionParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunctionParameter($item, $expectedFunction, $expectedParam) &&
            $item->attributeReflection()->getName() === $expectedAttribute
    );
});

expect()->extend('toContainTargetFunctionParameterWithAttributeInstance', function(string $expectedFunction, string $expectedParam, string $expectedAttribute, callable $callable) use($checkTargetReflectionFunctionParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionFunctionParameter($item, $expectedFunction, $expectedParam) &&
            $item->attributeReflection()->getName() === $expectedAttribute &&
            $callable($item->attributeInstance())
    );
});

expect()->extend('toContainTargetMethod', function(string $expectedClass, string $expectedMethod) use($checkTargetReflectionMethod) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethod($item, $expectedClass, $expectedMethod)
    );
});

expect()->extend('toContainTargetMethodWithAttribute', function(string $expectedClass, string $expectedMethod, string $expectedAttribute) use($checkTargetReflectionMethod) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethod($item, $expectedClass, $expectedMethod) &&
            $item->attributeReflection()->getName() === $expectedAttribute
    );
});

expect()->extend('toContainTargetMethodWithAttributeInstance', function(string $expectedClass, string $expectedMethod, string $expectedAttribute, callable $callable) use($checkTargetReflectionMethod) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethod($item, $expectedClass, $expectedMethod) &&
            $item->attributeReflection()->getName() === $expectedAttribute &&
            $callable($item->attributeInstance())
    );
});

expect()->extend('toContainTargetProperty', function(string $expectedClass, string $expectedProp) use($checkTargetReflectionProperty) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionProperty($item, $expectedClass, $expectedProp)
    );
});

expect()->extend('toContainTargetPropertyWithAttribute', function(string $expectedClass, string $expectedProp, string $expectedAttribute) use($checkTargetReflectionProperty) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionProperty($item, $expectedClass, $expectedProp) &&
            $item->attributeReflection()->getName() === $expectedAttribute
    );
});

expect()->extend('toContainTargetPropertyWithAttributeInstance', function(string $expectedClass, string $expectedProp, string $expectedAttribute, callable $callable) use($checkTargetReflectionProperty) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionProperty($item, $expectedClass, $expectedProp) &&
            $item->attributeReflection()->getName() === $expectedAttribute &&
            $callable($item->attributeInstance())
    );
});

expect()->extend('toContainTargetMethodParameter', function(string $expectedClass, string $expectedMethod, string $expectedParam) use($checkTargetReflectionMethodParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethodParameter($item, $expectedClass, $expectedMethod, $expectedParam)
    );
});

expect()->extend('toContainTargetMethodParameterWithAttribute', function(string $expectedClass, string $expectedMethod, string $expectedParam, string $expectedAttribute) use($checkTargetReflectionMethodParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethodParameter($item, $expectedClass, $expectedMethod, $expectedParam) &&
            $item->attributeReflection()->getName() === $expectedAttribute
    );
});

expect()->extend('toContainTargetMethodParameterWithAttributeInstance', function(string $expectedClass, string $expectedMethod, string $expectedParam, string $expectedAttribute, callable $callable) use($checkTargetReflectionMethodParameter) {
    return $this->toContainAny(
        fn(AnnotatedTarget $item) => $checkTargetReflectionMethodParameter($item, $expectedClass, $expectedMethod, $expectedParam) &&
            $item->attributeReflection()->getName() === $expectedAttribute &&
            $callable($item->attributeInstance())
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
