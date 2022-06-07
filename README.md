# Annotated Target

A static analysis tool for PHP 8 to gather all the places Attributes are used in a given codebase. In short, give this tool a set of directories, and we'll provide a Generator that yields information wherever an Attribute is found. You can filter by Attribute types to get info for just the things you need. Check out the Quick Start below for more info.

## Install

Use [Composer]() to install this package.

```php
composer require cspray/annotated-target
```

## Quick Start

The core concept in Annotated Target is an interface called `AnnotatedTarget` that tracks information about each place an Attribute is used in your codebase. It provides three pieces of data:

1. The `Reflector` that the Attribute was targeting. For example, if the Attribute was found targeting a class then a `ReflectionClass` would be available.
2. The `ReflectionAttribute` for the Attribute.
3. The instance for the given Attribute.

Let's take a look at some annotated code and how you'd get access to the parsed Attributes. We'll assume that this code exists in `__DIR__ . 'src/Foo.php'`.

```php
<?php declare(strict_types=1);

#[ClassAttr]
class Foo {

    #[PropAttr]
    private string $prop = 'foo';

    #[MethodAttr]
    public function getProp() : string {
        return $this->prop;
    }
    
}
```

Now, to get access to these Attribute we need to parse the source code. This is accomplished using the `Cspray\AnnotatedTarget\parseAttributes` function, or you could use the `Cspray\AnnotatedTarget\PhpParserAnnotatedTargetParser` directly. The `parseAttributes` function is the recommended way of interacting with this library.

If you want to get _all_ Attributes you can pass just the directories to scan. The library will take a look at all source files in the directory that end with `.php` and statically analyze them for Attribute uses. The first argument accepts either a string or an array, in case you have more than 1 directory to scan.

```php
<?php declare(strict_types=1);

use function Cspray\AnnotatedTarget\parseAttributes;

// parseAttributes returns a Generator, iterate over it to retrieve all Attributes found
foreach (parseAttributes(__DIR__ . '/src') as $annotatedTarget) {
    // $annotatedTarget is an instanceof AnnotatedTarget
    // This will be a ReflectionClass, ReflectionProperty, or ReflectionMethod depending on which iteration
    $target = $annotatedTarget->getTargetReflection();
    // This will be a ReflectionAttribute
    $attributeReflection = $annotatedTarget->getAttributeReflection();
    // This will be an instance of the Attribute returned from $this->getAttributeReflection()->newInstance()
    $attributeInstance = $annotatedTarget->getAttributeInstance();
    
    // All the methods above are shared
    $isShared = $annotatedTarget->getTargetReflection() === $annotatedTarget->getTargetReflection(); // true
}
```

If you only care about certain Attributes you can pass a second argument to `parseAttributes`, an array of Attribute types that we should filter by. For example, to get only the `#[MethodAttr]` Attribute we'd run the following.

```php
<?php declare(stric_types=1)

use function Cspray\AnnotatedTarget\parseAttributes;

foreach (parseAttributes(__DIR__ . '/src', [MethodAttr::class]) as $target) {
    // Only targets for usages of MethodAttr will be included
}
```

