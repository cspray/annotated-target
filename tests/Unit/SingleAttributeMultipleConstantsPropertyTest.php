<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Unit;

use Cspray\AnnotatedTargetFixture\ConstantOnly;
use Cspray\AnnotatedTargetFixture\Fixtures;
use function Cspray\Typiphy\objectType;

uses(AnnotatedTargetParserTestCase::class);

beforeEach()->withFixture(Fixtures::singleAttributeMultipleConstantsSingleClass());

it('counts targets for single constant')->assertTargetCount(2);

it('ensures all targets are correct types')->assertTargetTypes();

it('ensures all targets share target reflection')->assertTargetReflectionShared();

it('ensures all targets share attribute reflection')->assertAttributeReflectionShared();

it('ensures all targets share attribute instance')->assertAttributeInstanceShared();

it('contains first target reflection class constant')
    ->containsTargetClassConstant(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'FOO'
    );

it('contains second target reflection class constant')
    ->containsTargetClassConstant(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'BAR'
    );


it('contains first target reflection class constant with attribute')
    ->containsTargetClassConstantAndAttribute(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'FOO', objectType(ConstantOnly::class)
    );

it('contains second target reflection class constant with attribute')
    ->containsTargetClassConstantAndAttribute(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'BAR', objectType(ConstantOnly::class)
    );

it('contains first target reflection class constant with attribute instance')
    ->containsTargetClassConstantAndAttributeInstance(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'FOO', objectType(ConstantOnly::class),
        fn(ConstantOnly $constantOnly) => $constantOnly->value === 'Mallory'
    );

it('contains second target reflection class constant with attribute instance')
    ->containsTargetClassConstantAndAttributeInstance(
        Fixtures::singleAttributeMultipleConstantsSingleClass()->fooClass(), 'BAR', objectType(ConstantOnly::class),
        fn(ConstantOnly $constantOnly) => $constantOnly->value === 'Mallory'
    );
