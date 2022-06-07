<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTarget\AnnotatedTarget;
use Cspray\AnnotatedTarget\AnnotatedTargetParserOptionsBuilder;
use Cspray\AnnotatedTarget\PhpParserAnnotatedTargetParser;
use Cspray\AnnotatedTargetFixture\Fixture;
use Cspray\Typiphy\ObjectType;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;
use ReflectionProperty;

abstract class AnnotatedTargetParserTestCase extends TestCase {

    private array $fixtures;

    private function getSubject() : PhpParserAnnotatedTargetParser {
        return new PhpParserAnnotatedTargetParser();
    }

    private function getTargets() : array {
        if (!isset($this->fixtures)) {
            throw new \BadMethodCallException('Before running any assertions on this test case you must provide a Fixture to load.');
        }
        $paths = array_map(fn(Fixture $fixture) => $fixture->getPath(), $this->fixtures);
        $options = AnnotatedTargetParserOptionsBuilder::scanDirectories(...$paths)->build();
        return iterator_to_array($this->getSubject()->parse($options));
    }

    public function withFixtures(Fixture... $fixtures) : self {
        $this->fixtures = $fixtures;
        return $this;
    }

    private function passesReflectionClassCheck(AnnotatedTarget $target, ObjectType $expected) : bool {
        return $target->getTargetReflection() instanceof ReflectionClass &&
            $target->getTargetReflection()->getName() === $expected->getName();
    }

    private function passesReflectionPropertyCheck(AnnotatedTarget $target, ObjectType $expected, string $expectedProp) : bool {
        return $target->getTargetReflection() instanceof ReflectionProperty &&
            $target->getTargetReflection()->getDeclaringClass()->getName() === $expected->getName() &&
            $target->getTargetReflection()->getName() === $expectedProp;
    }

    private function passesReflectionClassConstantCheck(AnnotatedTarget $target, ObjectType $expectedClass, string $expectedConstant) : bool {
        return $target->getTargetReflection() instanceof ReflectionClassConstant &&
            $target->getTargetReflection()->getDeclaringClass()->getName() === $expectedClass->getName() &&
            $target->getTargetReflection()->getName() === $expectedConstant;
    }

    private function passesReflectionMethodCheck(AnnotatedTarget $target, ObjectType $expectedClass, string $expectedMethod) : bool {
        return $target->getTargetReflection() instanceof ReflectionMethod &&
            $target->getTargetReflection()->getDeclaringClass()->getName() === $expectedClass->getName() &&
            $target->getTargetReflection()->getName() === $expectedMethod;
    }

    private function passesReflectionFunctionCheck(AnnotatedTarget $target, string $expectedFunction) : bool {
        return $target->getTargetReflection() instanceof ReflectionFunction &&
            $target->getTargetReflection()->getName() === $expectedFunction;
    }

    private function passesMethodReflectionParameterCheck(AnnotatedTarget $target, ObjectType $expectedClass, string $expectedMethod, string $expectedParam) : bool {
        return $target->getTargetReflection() instanceof ReflectionParameter &&
            $target->getTargetReflection()->getDeclaringClass()->getName() === $expectedClass->getName() &&
            $target->getTargetReflection()->getDeclaringFunction()->getName() === $expectedMethod &&
            $target->getTargetReflection()->getName() === $expectedParam;
    }

    private function passesFunctionReflectionParameterCheck(AnnotatedTarget $target, string $expectedFunction, string $expectedParam) : bool {
        return $target->getTargetReflection() instanceof ReflectionParameter &&
            $target->getTargetReflection()->getDeclaringFunction()->getName() === $expectedFunction &&
            $target->getTargetReflection()->getName() === $expectedParam;
    }

    private function passesReflectionAttributeCheck(AnnotatedTarget $target, ObjectType $expected) : bool {
        return $target->getAttributeReflection()->getName() === $expected->getName();
    }

    public function assertTargetCount(int $count) : void {
        $this->assertCount($count, $this->getTargets());
    }

    public function assertTargetTypes() : void {
        expect($this->getTargets())->each->toBeInstanceOf(AnnotatedTarget::class);
    }

    public function assertTargetReflectionShared() : void {
        expect($this->getTargets())->each(function($expectation) {
            /** @var AnnotatedTarget $target */
            $target = $expectation->value;
            $first = $target->getTargetReflection();
            $second = $target->getTargetReflection();

            $this->assertSame($first, $second);
        });
    }

    public function assertAttributeReflectionShared() : void {
        expect($this->getTargets())->each(function($expectation) {
            /** @var AnnotatedTarget $target */
            $target = $expectation->value;
            $first = $target->getAttributeReflection();
            $second = $target->getAttributeReflection();

            $this->assertSame($first, $second);
        });
    }

    public function assertAttributeInstanceShared() : void {
        expect($this->getTargets())->each(function($expectation) {
            /** @var AnnotatedTarget $target */
            $target = $expectation->value;
            $first = $target->getAttributeInstance();
            $second = $target->getAttributeInstance();

            $this->assertSame($first, $second);
        });
    }

    // Checks for ReflectionClass

    public function containsTargetClass(ObjectType $expected) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionClassCheck($item, $expected)
        );
    }

    public function containsTargetClassAndAttribute(ObjectType $expected, ObjectType $expectedAttribute) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionClassCheck($item, $expected) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute)
        );
    }

    public function containsTargetClassAndAttributeInstance(
        ObjectType $expected,
        ObjectType $expectedAttribute,
        callable $callable
    ) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionClassCheck($item, $expected) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute) &&
                $callable($item->getAttributeInstance())
        );
    }

    // Checks for ReflectionProperty

    public function containsTargetProperty(ObjectType $expectedClass, string $expectedProp) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionPropertyCheck($item, $expectedClass, $expectedProp)
        );
    }

    public function containsTargetPropertyAndAttribute(ObjectType $expectedClass, string $expectedProp, ObjectType $expectedAttribute) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionPropertyCheck($item, $expectedClass, $expectedProp) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute)
        );
    }

    public function containsTargetPropertyAndAttributeInstance(
        ObjectType $expectedClass,
        string $expectedProp,
        ObjectType $expectedAttribute,
        callable $callable
    ) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionPropertyCheck($item, $expectedClass, $expectedProp) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute) &&
                $callable($item->getAttributeInstance())
        );
    }

    // Checks for ReflectionClassConstant

    public function containsTargetClassConstant(ObjectType $expectedClass, string $expectedConst) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionClassConstantCheck($item, $expectedClass, $expectedConst)
        );
    }

    public function containsTargetClassConstantAndAttribute(ObjectType $expectedClass, string $expectedConst, ObjectType $expectedAttribute) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionClassConstantCheck($item, $expectedClass, $expectedConst) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute)
        );
    }

    public function containsTargetClassConstantAndAttributeInstance(
        ObjectType $expectedClass,
        string $expectedConst,
        ObjectType $expectedAttribute,
        callable $callable
    ) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionClassConstantCheck($item, $expectedClass, $expectedConst) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute) &&
                $callable($item->getAttributeInstance())
        );
    }

    // Checks for ReflectionMethod

    public function containsTargetMethod(ObjectType $expectedClass, string $expectedMethod) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionMethodCheck($item, $expectedClass, $expectedMethod)
        );
    }

    public function containsTargetMethodAndAttribute(ObjectType $expectedClass, string $expectedMethod, ObjectType $expectedAttribute) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionMethodCheck($item, $expectedClass, $expectedMethod) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute)
        );
    }

    public function containsTargetMethodAndAttributeInstance(
        ObjectType $expectedClass,
        string $expectedMethod,
        ObjectType $expectedAttribute,
        callable $callable
    ) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionMethodCheck($item, $expectedClass, $expectedMethod) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute) &&
                $callable($item->getAttributeInstance())
        );
    }

    // Checks for ReflectionFunction

    public function containsTargetFunction(string $function) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionFunctionCheck($item, $function)
        );
    }

    public function containsTargetFunctionAndAttribute(string $function, ObjectType $expectedAttribute) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionFunctionCheck($item, $function) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute)
        );
    }

    public function containsTargetFunctionAndAttributeInstance(
        string $expectedFunction,
        ObjectType $expectedAttribute,
        callable $callable
    ) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesReflectionFunctionCheck($item, $expectedFunction) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute) &&
                $callable($item->getAttributeInstance())
        );
    }

    // Checks for method ReflectionParameter

    public function containsTargetMethodParameter(ObjectType $expectedClass, string $expectedMethod, string $expectedParam) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesMethodReflectionParameterCheck($item, $expectedClass, $expectedMethod, $expectedParam)
        );
    }

    public function containsTargetMethodParameterAndAttribute(ObjectType $expectedClass, string $expectedMethod, string $expectedParam, ObjectType $expectedAttribute) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesMethodReflectionParameterCheck($item, $expectedClass, $expectedMethod, $expectedParam) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute)
        );
    }

    public function containsTargetMethodParameterAndAttributeInstance(
        ObjectType $expectedClass,
        string $expectedMethod,
        string $expectedParam,
        ObjectType $expectedAttribute,
        callable $callable
    ) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesMethodReflectionParameterCheck($item, $expectedClass, $expectedMethod, $expectedParam) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute) &&
                $callable($item->getAttributeInstance())
        );
    }

    // Checks for function ReflectionParameter

    public function containsTargetFunctionParameter(string $expectedFunction, string $expectedParam) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesFunctionReflectionParameterCheck($item, $expectedFunction, $expectedParam)
        );
    }

    public function containsTargetFunctionParameterAndAttribute(
        string $expectedFunction,
        string $expectedParam,
        ObjectType $expectedAttribute
    ) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesFunctionReflectionParameterCheck($item, $expectedFunction, $expectedParam) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute)
        );
    }

    public function containsTargetFunctionParameterAndAttributeInstance(
        string $expectedFunction,
        string $expectedParam,
        ObjectType $expectedAttribute,
        callable $callable
    ) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesFunctionReflectionParameterCheck($item, $expectedFunction, $expectedParam) &&
                $this->passesReflectionAttributeCheck($item, $expectedAttribute) &&
                $callable($item->getAttributeInstance())
        );
    }

}