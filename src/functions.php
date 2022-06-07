<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use Generator;
use function Cspray\Typiphy\objectType;

function parseAttributes(array|string $directories, array $filterAttributes = []) : Generator {
    $parser = new PhpParserAnnotatedTargetParser();
    $directories = is_string($directories) ? [$directories] : $directories;

    $builder = AnnotatedTargetParserOptionsBuilder::scanDirectories(...$directories);
    if (!empty($filterAttributes)) {
        $attributeTypes = array_map(fn($type) => objectType($type), $filterAttributes);
        $builder = $builder->filterAttributes(...$attributeTypes);
    }
    return $parser->parse($builder->build());
}