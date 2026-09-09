<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PageController extends Controller
{
    public function edit(Page $page): View
    {
        $page->load('sections');

        return view('admin.pages.edit', ['page' => $page]);
    }

    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        DB::transaction(function () use ($request, $page): void {
            $page->update([
                ...$request->safe()->only(['name', 'title', 'meta_title', 'meta_description', 'og_image']),
                'is_active' => $request->boolean('is_active'),
            ]);

            foreach ($request->validated('sections') as $sectionId => $sectionData) {
                $section = $page->sections()->whereKey($sectionId)->firstOrFail();
                $section->update([
                    'title' => $sectionData['title'] ?? null,
                    'subtitle' => $sectionData['subtitle'] ?? null,
                    'content' => filled($sectionData['content'] ?? null) ? json_decode($sectionData['content'], true, flags: JSON_THROW_ON_ERROR) : null,
                    'sort_order' => $sectionData['sort_order'],
                    'is_active' => (bool) ($sectionData['is_active'] ?? false),
                ]);
            }
        });

        return back()->with('status', 'Contenido y SEO actualizados correctamente.');
    }
}
