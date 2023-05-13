<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTarget\Exception\InvalidPhpSyntax;
use Cspray\AnnotatedTargetFixture\Fixtures;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixtures(Fixtures::invalidSyntax());


it('throws an exception if invalid PHP syntax is encountered', fn() => $this->getTargets())
    ->throws(
        InvalidPhpSyntax::class,
        'Encountered error parsing ' . Fixtures::invalidSyntax()->getPath() . '/BadPhpFile.php. Message: Syntax error, unexpected \':\', expecting \';\' on line 8'
    );