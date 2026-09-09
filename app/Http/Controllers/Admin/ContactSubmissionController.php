<?php

namespace App\Http\Controllers\Admin;

use App\ContactSubmissionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateContactSubmissionRequest;
use App\Models\ContactSubmission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContactSubmissionController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'status' => ['nullable', Rule::enum(ContactSubmissionStatus::class)],
            'search' => ['nullable', 'string', 'max:120'],
            'direction' => ['nullable', Rule::in(['asc', 'desc'])],
        ]);

        $search = trim((string) ($filters['search'] ?? ''));

        $submissions = ContactSubmission::query()
            ->when($filters['status'] ?? null, fn (Builder $query, string $status): Builder => $query->where('status', $status))
            ->when($search !== '', fn (Builder $query): Builder => $query->where(function (Builder $query) use ($search): void {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('company', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            }))
            ->orderBy('created_at', $filters['direction'] ?? 'desc')
            ->orderBy('id', $filters['direction'] ?? 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.contacts.index', [
            'submissions' => $submissions,
            'statuses' => ContactSubmissionStatus::cases(),
        ]);
    }

    public function show(ContactSubmission $contactSubmission): View
    {
        return view('admin.contacts.show', [
            'submission' => $contactSubmission,
            'statuses' => ContactSubmissionStatus::cases(),
        ]);
    }

    public function update(UpdateContactSubmissionRequest $request, ContactSubmission $contactSubmission): RedirectResponse
    {
        $contactSubmission->update($request->safe()->only('status'));

        return back()->with('status', 'Estado actualizado correctamente.');
    }
}
