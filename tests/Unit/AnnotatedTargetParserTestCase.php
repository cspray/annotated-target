<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTarget\AnnotatedTargetParserOptions;
use Cspray\AnnotatedTarget\AnnotatedTargetParserOptionsBuilder;
use Cspray\AnnotatedTarget\PhpParserAnnotatedTargetParser;
use Cspray\AnnotatedTargetFixture\Fixture;
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
        $options = AnnotatedTargetParserOptions::scanAllAttributes(...$paths);
        if (isset($this->attributes)) {
            $options = AnnotatedTargetParserOptions::scanForSpecificAttributes(
                $paths,
                $this->attributes
            );
        }
        return iterator_to_array($this->getSubject()->parse($options));
    }

    public function withFixtures(Fixture... $fixtures) : self {
        $this->fixtures = $fixtures;
        return $this;
    }

    /**
     * @param class-string ...$attributes
     * @return $this
     */
    public function withFilteredAttributes(string... $attributes) : self {
        $this->attributes = $attributes;
        return $this;
    }

}