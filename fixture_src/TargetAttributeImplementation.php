<?php

namespace Cspray\AnnotatedTargetFixture;

#[\Attribute(\Attribute::TARGET_CLASS)]
final class TargetAttributeImplementation implements TargetAttributeInterface {

    public function __construct(public readonly string $value) {}
}