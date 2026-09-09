<?php

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('lets an administrator upload a validated image', function () {
    Storage::fake('public');
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->post(route('admin.media.store'), ['image' => UploadedFile::fake()->image('equipo.webp', 1200, 800)->size(900), 'alt_text' => 'Equipo jurídico reunido'])->assertRedirect()->assertSessionHas('status');

    $media = Media::query()->firstOrFail();
    Storage::disk('public')->assertExists($media->path);
    expect($media->alt_text)->toBe('Equipo jurídico reunido');
});

it('rejects non image uploads', function () {
    Storage::fake('public');
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->post(route('admin.media.store'), ['image' => UploadedFile::fake()->create('payload.php', 10, 'application/x-php')])->assertInvalid('image');

    expect(Media::query()->count())->toBe(0);
});
