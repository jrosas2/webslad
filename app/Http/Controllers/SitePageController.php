<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SiteSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use InvalidArgumentException;

class SitePageController extends Controller
{
    public function home(): View
    {
        return $this->renderPage('home');
    }

    public function product(): View
    {
        return $this->renderPage('producto');
    }

    public function about(): View
    {
        return $this->renderPage('nosotros');
    }

    public function contact(): View
    {
        session()->put('contact_submission_token', session('contact_submission_token', Str::uuid()->toString()));

        return $this->renderPage('contacto', [
            'submissionToken' => session('contact_submission_token'),
        ]);
    }

    /** @param array<string, mixed> $data */
    private function renderPage(string $slug, array $data = []): View
    {
        $page = Page::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with('activeSections')
            ->firstOrFail();

        /** @var Collection<string, PageSection> $sections */
        $sections = $page->activeSections->keyBy('section_key');
        $settings = SiteSetting::query()->pluck('value', 'key');

        $view = match ($slug) {
            'home' => 'site.pages.home',
            'producto' => 'site.pages.producto',
            'nosotros' => 'site.pages.nosotros',
            'contacto' => 'site.pages.contacto',
            default => throw new InvalidArgumentException("Página pública no soportada: $slug"),
        };

        return view($view, [
            ...$data,
            'page' => $page,
            'sections' => $sections,
            'settings' => $settings,
        ]);
    }
}
