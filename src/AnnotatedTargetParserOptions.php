<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

interface AnnotatedTargetParserOptions {

    /**
     * @return non-empty-list<non-empty-string>
     */
    public function sourceDirectories() : array;

    /**
     * @return non-empty-list<class-string>
     */
    public function attributeTypes() : array;

}