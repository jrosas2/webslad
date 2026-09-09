<?php

use Database\Seeders\SiteContentSeeder;

test('returns a successful response', function () {
    $this->seed(SiteContentSeeder::class);

    $response = $this->get(route('home'));

    $response->assertOk();
});
