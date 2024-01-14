<?php

use Keky\Product\Models\OptionValue;

uses(\Keky\Product\Tests\TestCase::class)->in('Feature');

describe('Basic optionValue tests', function () {
    it('Count default OptionValue', function () {
        expect(OptionValue::count())->toBe(0);
    });

    it('Create OptionValue by route call with error', function () {
        $data = OptionValue::factory()->make()->toArray();
        $data['value'] = 3000;
        $response = $this->post('/option-values', $data);
        $response->assertBadRequest();

        $counter = OptionValue::count();

        expect($counter)->toBeInt()->toBeInt()->toBe(0);
    });

    it('First OptionValue creation with factories', function () {
        OptionValue::factory()->create();
        expect(OptionValue::count())->toBeInt()->toBe(1);
    });
});
