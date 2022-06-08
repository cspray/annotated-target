# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.1.0](https://github.com/cspray/annotated-target/tree/v0.1.0) - 2022-06-08

### Added

- `AnnotatedTarget` interface, an object that represents a distinct use of an Attribute within a codebase. Provides access to the `Reflector` the Attribute was targeting, the `ReflectionAttribute` found, and an instance of the Attribute.
- `AnnotatedTargetOptions` and `AnnotatedTargetParser` interfaces, implementations are reponsible for converting source code into `AnnotatedTarget` implementations.
- `AnnotatedTargetOptionsBuilder` for building an implementation of `AnnotatedTargetOptions`.
- `PhpParserAnnotatedTargetParser` for statically analyzing multiple source directories and gather all uses of Attributes with the PHP-Parser library.
- A functional API, through `parseAttributes`, that allows for straight-forward use of the aforementioned objects.