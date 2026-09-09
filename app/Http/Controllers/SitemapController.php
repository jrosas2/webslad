<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $routeNames = [
            'home' => 'home',
            'producto' => 'producto',
            'nosotros' => 'nosotros',
            'contacto' => 'contacto',
        ];

        $pages = Page::query()
            ->where('is_active', true)
            ->whereIn('slug', array_keys($routeNames))
            ->oldest('id')
            ->get()
            ->map(fn (Page $page): array => [
                'url' => route($routeNames[$page->slug]),
                'updated_at' => $page->updated_at,
            ]);

        return response()
            ->view('site.sitemap', ['pages' => $pages])
            ->header('Content-Type', 'application/xml');
    }
}
