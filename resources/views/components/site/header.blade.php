@props(['settings'])
<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 shadow-[0_1px_8px_rgba(15,23,42,0.04)] backdrop-blur">
    <div class="site-container flex h-20 items-center justify-between gap-4">
        <a href="{{ route('home') }}" aria-label="Ir al inicio">
            @if (filled($settings['logo_path'] ?? null))
                <img src="{{ asset('storage/'.$settings['logo_path']) }}" alt="{{ $settings['site_name'] ?? 'SLAD' }}" class="h-10 w-auto">
            @else
                <x-site.logo />
            @endif
        </a>

        <nav class="hidden items-center gap-7 md:flex" aria-label="Navegación principal">
            @foreach (['home' => 'Home', 'producto' => 'Producto', 'nosotros' => 'Nosotros', 'contacto' => 'Contacto'] as $routeName => $label)
                <a href="{{ route($routeName) }}" @class(['text-sm transition hover:text-blue-700', 'font-semibold text-blue-700' => request()->routeIs($routeName), 'text-slate-600' => ! request()->routeIs($routeName)]) @if(request()->routeIs($routeName)) aria-current="page" @endif>{{ $label }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2">
            <a href="{{ route('contacto') }}" class="primary-button hidden sm:inline-flex">Solicitar demostración</a>
            <a href="{{ auth()->check() ? route('admin.dashboard') : route('login') }}" class="flex size-10 items-center justify-center rounded-full bg-slad-deep text-white" aria-label="Acceso administrativo">
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M19 8v6M16 11h6"/></svg>
            </a>
            <details class="relative md:hidden">
                <summary class="flex size-10 cursor-pointer list-none items-center justify-center rounded-lg border border-slate-200 bg-white" aria-label="Abrir menú">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                </summary>
                <nav class="absolute right-0 mt-3 w-56 rounded-xl border border-slate-200 bg-white p-2 shadow-xl" aria-label="Navegación móvil">
                    @foreach (['home' => 'Home', 'producto' => 'Producto', 'nosotros' => 'Nosotros', 'contacto' => 'Contacto'] as $routeName => $label)
                        <a href="{{ route($routeName) }}" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-slate-50">{{ $label }}</a>
                    @endforeach
                </nav>
            </details>
        </div>
    </div>
</header>
