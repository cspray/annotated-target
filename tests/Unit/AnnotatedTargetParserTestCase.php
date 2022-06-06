<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTarget\AnnotatedTarget;
use Cspray\AnnotatedTarget\AnnotatedTargetParserOptionsBuilder;
use Cspray\AnnotatedTarget\PhpParserAnnotatedTargetParser;
use Cspray\AnnotatedTargetFixture\Fixture;
use Cspray\Typiphy\ObjectType;
use PHPUnit\Framework\TestCase;

abstract class AnnotatedTargetParserTestCase extends TestCase {

    private Fixture $fixture;

    private function getSubject() : PhpParserAnnotatedTargetParser {
        return new PhpParserAnnotatedTargetParser();
    }

    private function getTargets() : array {
        $options = AnnotatedTargetParserOptionsBuilder::scanDirectories($this->fixture->getPath())->build();
        return iterator_to_array($this->getSubject()->parse($options));
    }

    public function withFixture(Fixture $fixture) : self {
        $this->fixture = $fixture;
        return $this;
    }

    public function assertTargetCount(int $count) : void {
        $this->assertCount($count, $this->getTargets());
    }

    public function assertTargetTypes() : void {
        expect($this->getTargets())->each->toBeInstanceOf(AnnotatedTarget::class);
    }

    public function assertContainsTargetReflectionClassType(ObjectType $expected) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $item->getTargetReflection()->getName() === $expected->getName()
        );
    }

    public function assertContainsTargetReflectionClassTypeAndReflectionAttributeType(ObjectType $expectedTarget, ObjectType $expectedAttribute) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesTargetAndAttributeTypeCheck($item, $expectedTarget, $expectedAttribute)
        );
    }

    public function assertContainsTargetReflectionClassTypeAndValidReflectionAttributeInstance(
        ObjectType $expectedTarget,
        ObjectType $expectedAttribute,
        callable $callable
    ) : void {
        expect($this->getTargets())->toContainAny(
            fn(AnnotatedTarget $item) => $this->passesTargetAndAttributeTypeCheck($item, $expectedTarget, $expectedAttribute) && $callable($item->getAttributeInstance())
        );
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

    private function passesTargetAndAttributeTypeCheck(AnnotatedTarget $target, ObjectType $expectedTarget, ObjectType $expectedAttribute) : bool {
        return $target->getTargetReflection()->getName() === $expectedTarget->getName() &&
            $target->getAttributeReflection()->getName() === $expectedAttribute->getName();
    }

}