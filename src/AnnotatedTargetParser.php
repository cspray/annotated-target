<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Generator;

interface AnnotatedTargetParser {

    public function parser(AnnotatedTargetParserOptions $options) : Generator;

}