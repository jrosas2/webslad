<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactSubmissionRequest;
use App\Mail\NewContactSubmission;
use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactSubmissionController extends Controller
{
    public function store(StoreContactSubmissionRequest $request): RedirectResponse
    {
        $sessionToken = (string) $request->session()->get('contact_submission_token');
        abort_unless($sessionToken !== '' && hash_equals($sessionToken, $request->string('submission_token')->toString()), 419);

        $submission = ContactSubmission::query()->firstOrCreate(
            ['submission_token' => $request->string('submission_token')->toString()],
            [
                ...$request->safe()->only(['name', 'company', 'position', 'email', 'phone', 'estimated_users', 'needs', 'message']),
                'ip_address' => $request->ip(),
            ],
        );

        if ($submission->wasRecentlyCreated && filled(config('slad.contact_email'))) {
            try {
                Mail::to(config('slad.contact_email'))->send(new NewContactSubmission($submission));
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        $request->session()->forget('contact_submission_token');

        return redirect()->route('contacto')->with('contact_success', 'Solicitud recibida. Un consultor se comunicará con usted a la brevedad.');
    }
}
