<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

interface AnnotatedTargetParserOptions {

    public function getSourceDirectories() : array;

    public function getAttributeTypes() : array;

}