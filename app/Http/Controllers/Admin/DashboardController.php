<?php

namespace App\Http\Controllers\Admin;

use App\ContactSubmissionStatus;
use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\Media;
use App\Models\Page;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'pageCount' => Page::query()->count(),
            'mediaCount' => Media::query()->count(),
            'newContactCount' => ContactSubmission::query()->where('status', ContactSubmissionStatus::Nuevo)->count(),
            'recentContacts' => ContactSubmission::query()->latest()->limit(5)->get(),
        ]);
    }
}
