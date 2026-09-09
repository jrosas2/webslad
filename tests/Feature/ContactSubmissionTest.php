<?php

use App\Mail\NewContactSubmission;
use App\Models\ContactSubmission;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

it('stores a valid contact request and sends the administrator email', function () {
    $this->seed(SiteContentSeeder::class);
    Mail::fake();
    config(['slad.contact_email' => 'admin@slad.test']);
    $token = Str::uuid()->toString();

    $response = $this->withSession(['contact_submission_token' => $token])->post(route('contacto.store'), [
        'submission_token' => $token,
        'name' => 'María Soto',
        'company' => 'Corporación Andina',
        'position' => 'Gerenta Legal',
        'email' => 'maria@andina.test',
        'phone' => '+56 9 5555 5555',
        'estimated_users' => '16-50',
        'needs' => ['causas', 'documentos'],
        'message' => 'Necesitamos centralizar nuestra cartera de litigios.',
    ]);

    $response->assertRedirect(route('contacto'))->assertSessionHas('contact_success');
    $this->assertDatabaseHas('contact_submissions', ['email' => 'maria@andina.test', 'company' => 'Corporación Andina']);
    Mail::assertSent(NewContactSubmission::class, fn (NewContactSubmission $mail): bool => $mail->submission->email === 'maria@andina.test');
});

it('rejects missing required fields and invalid email addresses', function () {
    $token = Str::uuid()->toString();

    $this->withSession(['contact_submission_token' => $token])->post(route('contacto.store'), [
        'submission_token' => $token,
        'email' => 'correo-invalido',
    ])->assertInvalid(['name', 'company', 'email', 'message']);

    expect(ContactSubmission::query()->count())->toBe(0);
});

it('does not create a duplicate submission with the same token', function () {
    $token = Str::uuid()->toString();
    $payload = ['submission_token' => $token, 'name' => 'Ana Pérez', 'company' => 'Legal SpA', 'email' => 'ana@legal.test', 'message' => 'Solicito información.'];

    $this->withSession(['contact_submission_token' => $token])->post(route('contacto.store'), $payload)->assertRedirect();
    $this->withSession(['contact_submission_token' => $token])->post(route('contacto.store'), $payload)->assertRedirect();

    expect(ContactSubmission::query()->count())->toBe(1);
});

it('rate limits repeated contact requests', function () {
    for ($attempt = 1; $attempt <= 5; $attempt++) {
        $token = Str::uuid()->toString();
        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.9'])->withSession(['contact_submission_token' => $token])->post(route('contacto.store'), [
            'submission_token' => $token, 'name' => 'Solicitante', 'company' => 'Empresa', 'email' => 'rate@limit.test', 'message' => 'Solicitud número '.$attempt,
        ])->assertRedirect();
    }

    $token = Str::uuid()->toString();
    $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.9'])->withSession(['contact_submission_token' => $token])->post(route('contacto.store'), [
        'submission_token' => $token, 'name' => 'Solicitante', 'company' => 'Empresa', 'email' => 'rate@limit.test', 'message' => 'Solicitud adicional',
    ])->assertTooManyRequests();
});
