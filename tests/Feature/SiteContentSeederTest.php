<?php

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SiteSetting;
use Database\Seeders\SiteContentSeeder;

it('creates the four public pages with their complete initial content', function () {
    $this->seed(SiteContentSeeder::class);

    expect(Page::query()->orderBy('id')->pluck('slug')->all())->toBe(['home', 'producto', 'nosotros', 'contacto'])
        ->and(PageSection::query()->count())->toBe(30)
        ->and(SiteSetting::query()->count())->toBe(11);

    $this->assertDatabaseHas('page_sections', ['section_key' => 'producto.security', 'is_active' => true]);
    $this->assertDatabaseHas('page_sections', ['section_key' => 'contacto.form', 'is_active' => true]);
});
