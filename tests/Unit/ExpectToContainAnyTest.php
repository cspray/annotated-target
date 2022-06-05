<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget;

use PHPUnit\Framework\AssertionFailedError;

it('throws exception if value is not iterable', function() {
    expect(true)->toContainAny(fn() => false);
})->throws(\BadMethodCallException::class, 'Expectation value is not iterable.');

it('fails if no values', function() {
    expect([])->toContainAny(fn() => true);
})->throws(AssertionFailedError::class, 'Failed asserting that any item in expected iterable passes callable.');

it('fails if no values, with custom message', function() {
    expect([])->toContainAny(fn() => true, 'Failed doing the thing');
})->throws(AssertionFailedError::class, 'Failed doing the thing');

it('passes if callback returns true with items', function() {
    expect([1])->toContainAny(fn() => true);
});

it('fails if callback returns false with items', function() {
    expect([1])->toContainAny(fn() => false);
})->throws(AssertionFailedError::class, 'Failed asserting that any item in expected iterable passes callable.');

it('passes if callback returns true with items, item passed to callback', function() {
    expect(['foo', 'bar', 'baz'])->toContainAny(fn($item) => $item === 'baz');
});