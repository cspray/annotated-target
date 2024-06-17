<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Generator;

interface AnnotatedTargetParser {

    /**
     * @param AnnotatedTargetParserOptions $options
     * @return Generator<AnnotatedTarget>
     */
    public function parse(AnnotatedTargetParserOptions $options) : Generator;

}