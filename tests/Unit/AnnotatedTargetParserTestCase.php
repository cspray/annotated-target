<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTarget\AnnotatedTarget;
use Cspray\AnnotatedTarget\AnnotatedTargetParserOptionsBuilder;
use Cspray\AnnotatedTarget\PhpParserAnnotatedTargetParser;
use Cspray\AnnotatedTargetFixture\Fixture;
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

}