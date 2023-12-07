<?php

uses(\Keky\Product\Tests\TestCase::class)->in('Feature');

it('performs sums', function () {
    //    $response = $this->get('/');
    //    $response->assertStatus(200);
    $result = 1 + 2;

    expect($result)->toBe(3);
});
