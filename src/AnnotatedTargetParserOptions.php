<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Cspray\Typiphy\ObjectType;

interface AnnotatedTargetParserOptions {

    /**
     * @return list<non-empty-string>
     */
    public function sourceDirectories() : array;

    /**
     * @return list<ObjectType>
     */
    public function attributeTypes() : array;

}