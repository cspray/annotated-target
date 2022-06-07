<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTarget\AnnotatedTargetParserOptionsBuilder;
use Cspray\AnnotatedTarget\PhpParserAnnotatedTargetParser;
use Cspray\AnnotatedTargetFixture\Fixture;
use Cspray\Typiphy\ObjectType;
use PHPUnit\Framework\TestCase;

abstract class AnnotatedTargetParserTestCase extends TestCase {

    private array $fixtures;
    private array $attributes;

    private function getSubject() : PhpParserAnnotatedTargetParser {
        return new PhpParserAnnotatedTargetParser();
    }

    public function getTargets() : array {
        if (!isset($this->fixtures)) {
            throw new \BadMethodCallException('Before running any assertions on this test case you must provide a Fixture to load.');
        }
        $paths = array_map(fn(Fixture $fixture) => $fixture->getPath(), $this->fixtures);
        $builder = AnnotatedTargetParserOptionsBuilder::scanDirectories(...$paths);
        if (isset($this->attributes)) {
            $builder = $builder->filterAttributes(...$this->attributes);
        }
        return iterator_to_array($this->getSubject()->parse($builder->build()));
    }

    public function withFixtures(Fixture... $fixtures) : self {
        $this->fixtures = $fixtures;
        return $this;
    }

    public function withFilteredAttributes(ObjectType... $attributes) : self {
        $this->attributes = $attributes;
        return $this;
    }

}