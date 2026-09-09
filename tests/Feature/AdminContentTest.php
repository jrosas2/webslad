<?php

use App\ContactSubmissionStatus;
use App\Models\ContactSubmission;
use App\Models\Page;
use App\Models\User;
use Database\Seeders\SiteContentSeeder;

it('redirects guests from the administration area', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
});

it('forbids authenticated non administrators', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get(route('admin.dashboard'))->assertForbidden();
});

it('allows administrators to access the dashboard', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk()->assertSeeText('Dashboard administrativo');
});

it('updates page content and seo metadata', function () {
    $this->seed(SiteContentSeeder::class);
    $admin = User::factory()->admin()->create();
    $page = Page::query()->where('slug', 'home')->with('sections')->firstOrFail();
    $section = $page->sections->first();

    $this->actingAs($admin)->put(route('admin.pages.update', $page), [
        'name' => 'Inicio', 'title' => 'Nueva portada SLAD', 'meta_title' => 'Nuevo SEO SLAD', 'meta_description' => 'Descripción actualizada para los resultados de búsqueda.', 'og_image' => 'site/portada.webp', 'is_active' => '1',
        'sections' => [$section->id => ['title' => 'Hero actualizado', 'subtitle' => 'Nuevo subtítulo', 'content' => json_encode(['eyebrow' => 'Nueva etiqueta']), 'sort_order' => 10, 'is_active' => '1']],
    ])->assertRedirect()->assertSessionHas('status');

    $this->assertDatabaseHas('pages', ['id' => $page->id, 'meta_title' => 'Nuevo SEO SLAD']);
    $this->assertDatabaseHas('page_sections', ['id' => $section->id, 'title' => 'Hero actualizado']);
});

it('shows contact details safely and updates their status', function () {
    $admin = User::factory()->admin()->create();
    $submission = ContactSubmission::factory()->create(['name' => '<script>alert(1)</script>']);

    $this->actingAs($admin)->get(route('admin.contacts.show', $submission))->assertOk()->assertSee('&lt;script&gt;', false)->assertDontSee('<script>alert(1)</script>', false);
    $this->actingAs($admin)->patch(route('admin.contacts.update', $submission), ['status' => ContactSubmissionStatus::Contactado->value])->assertRedirect();

    expect($submission->refresh()->status)->toBe(ContactSubmissionStatus::Contactado);
});
