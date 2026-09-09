<?php

use App\Models\Page;
use Database\Seeders\SiteContentSeeder;

it('renders each public page', function (string $routeName, string $heading) {
    $this->seed(SiteContentSeeder::class);

    $this->get(route($routeName))->assertOk()->assertSeeText($heading);
})->with([
    'home' => ['home', 'Gestione sus causas jurídicas'],
    'producto' => ['producto', 'Una plataforma para gestionar'],
    'nosotros' => ['nosotros', 'Tecnología aplicada'],
    'contacto' => ['contacto', 'Conversemos sobre su gestión jurídica'],
]);

it('returns not found for inactive public pages', function () {
    $this->seed(SiteContentSeeder::class);
    Page::query()->where('slug', 'producto')->update(['is_active' => false]);

    $this->get(route('producto'))->assertNotFound();
});

it('returns not found for unknown routes', function () {
    $this->get('/pagina-inexistente')->assertNotFound();
});

it('publishes only active pages in the sitemap', function () {
    $this->seed(SiteContentSeeder::class);
    Page::query()->where('slug', 'nosotros')->update(['is_active' => false]);

    $this->get(route('sitemap'))
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml')
        ->assertSee(route('producto'), false)
        ->assertDontSee(route('nosotros'), false)
        ->assertDontSee('/admin', false);
});
