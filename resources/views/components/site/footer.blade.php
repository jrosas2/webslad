@props(['settings'])
<footer class="bg-[#11264a] py-14 text-white">
    <div class="site-container">
        <div class="grid gap-10 border-b border-white/15 pb-10 md:grid-cols-12">
            <div class="md:col-span-7">
                <x-site.logo class="text-white [&_span_span:last-child]:text-blue-200" />
                <p class="mt-4 max-w-lg text-sm leading-6 text-slate-300">Plataforma integral para centralizar, organizar y dar seguimiento a la gestión jurídica corporativa.</p>
            </div>
            <div class="md:col-span-5">
                <p class="text-xs font-bold tracking-widest text-blue-200 uppercase">Navegación</p>
                <nav class="mt-4 grid grid-cols-2 gap-3 text-sm text-slate-300" aria-label="Navegación del pie">
                    <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                    <a href="{{ route('producto') }}" class="hover:text-white">Producto</a>
                    <a href="{{ route('nosotros') }}" class="hover:text-white">Nosotros</a>
                    <a href="{{ route('contacto') }}" class="hover:text-white">Contacto</a>
                </nav>
            </div>
        </div>
        <div class="flex flex-col gap-3 pt-7 text-xs text-slate-300 sm:flex-row sm:items-center sm:justify-between">
            <span>{{ $settings['copyright'] ?? '© 2026 SLAD. Todos los derechos reservados.' }}</span>
            <span>{{ $settings['footer_note'] ?? 'Gestión Jurídica y Cumplimiento Corporativo' }}</span>
        </div>
    </div>
</footer>
