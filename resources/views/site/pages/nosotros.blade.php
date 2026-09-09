<x-site.layout :page="$page" :settings="$settings">
    @php
        $hero = $sections->get('nosotros.hero');
        $purpose = $sections->get('nosotros.purpose');
        $vision = $sections->get('nosotros.vision');
        $values = $sections->get('nosotros.values');
        $approach = $sections->get('nosotros.approach');
        $cta = $sections->get('nosotros.cta');
    @endphp

    @if ($hero)
        <section class="dot-grid bg-white py-14 lg:py-20">
            <div class="site-container">
                <p class="eyebrow">{{ data_get($hero->content, 'eyebrow') }}</p>
                <h1 class="mt-4 max-w-4xl text-4xl font-bold tracking-[-0.035em] lg:text-5xl">{{ $hero->title }}</h1>
                <p class="mt-5 max-w-3xl text-base leading-7 text-slate-600">{{ $hero->subtitle }}</p>
                <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach(data_get($hero->content, 'metrics', []) as $metric)
                        <article class="rounded-xl border border-blue-100 bg-[#edf3ff] p-5"><p class="data-label">{{ $metric['label'] }}</p><p class="mt-2 text-3xl font-bold text-blue-800">{{ $metric['value'] }}</p><p class="mt-2 text-xs leading-5 text-slate-600">{{ $metric['detail'] }}</p></article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($purpose || $vision)
        <section class="site-section bg-slad-canvas">
            <div class="site-container grid gap-6 lg:grid-cols-2">
                @if($purpose)<article class="legal-card flex min-h-72 flex-col justify-between p-7"><div><p class="eyebrow">{{ data_get($purpose->content, 'eyebrow') }}</p><h2 class="mt-3 text-3xl font-bold">{{ $purpose->title }}</h2><p class="mt-4 leading-7 text-slate-600">{{ $purpose->subtitle }}</p></div><ul class="mt-8 flex flex-wrap gap-3">@foreach(data_get($purpose->content, 'traits', []) as $trait)<li class="rounded-full bg-blue-50 px-3 py-2 text-xs font-medium text-blue-800">✓ {{ $trait }}</li>@endforeach</ul></article>@endif
                @if($vision)<article class="flex min-h-72 flex-col justify-between rounded-xl bg-slad-deep p-7 text-white"><div><p class="eyebrow text-blue-300">{{ data_get($vision->content, 'eyebrow') }}</p><h2 class="mt-3 text-3xl font-bold">{{ $vision->title }}</h2><p class="mt-4 leading-7 text-slate-300">{{ $vision->subtitle }}</p></div><p class="mt-8 rounded-lg bg-white/10 p-4 text-xs leading-5 text-blue-100">{{ data_get($vision->content, 'note') }}</p></article>@endif
            </div>
            <div class="site-container mt-8 grid grid-cols-1 gap-4 md:grid-cols-3" aria-label="Entorno profesional SLAD">
                @foreach ([['Equipos legales multidisciplinarios', 'from-slate-700 to-blue-900'], ['Transición fluida a la digitalización', 'from-blue-800 to-slate-900'], ['Control preventivo y estratégico', 'from-slate-800 to-blue-700']] as [$label, $gradient])
                    <div class="relative h-48 overflow-hidden rounded-xl bg-gradient-to-br {{ $gradient }} p-5 text-white"><div class="absolute inset-0 dot-grid opacity-20"></div><div class="relative flex h-full items-end"><p class="text-sm font-semibold">{{ $label }}</p></div></div>
                @endforeach
            </div>
        </section>
    @endif

    @if ($values)
        <section class="site-section bg-white"><div class="site-container"><x-site.section-heading :eyebrow="data_get($values->content, 'eyebrow')" :title="$values->title" :subtitle="$values->subtitle" /><div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">@foreach(data_get($values->content, 'items', []) as $item)<article class="rounded-xl bg-[#edf3ff] p-6"><p class="data-label text-blue-700">{{ $item['number'] }} · Principio rector</p><h3 class="mt-4 text-xl font-semibold">{{ $item['title'] }}</h3><p class="mt-3 text-sm leading-6 text-slate-600">{{ $item['description'] }}</p><p class="mt-7 text-xs font-semibold text-blue-700">→ {{ $item['tag'] }}</p></article>@endforeach</div></div></section>
    @endif

    @if ($approach)
        <section class="site-section bg-slad-canvas"><div class="site-container grid items-center gap-10 lg:grid-cols-12"><div class="lg:col-span-5"><p class="eyebrow">Plataforma unificada</p><h2 class="mt-3 text-4xl font-bold tracking-tight">{{ $approach->title }}</h2><p class="mt-5 leading-7 text-slate-600">{{ $approach->subtitle }}</p><div class="mt-7 rounded-xl bg-[#edf3ff] p-5 text-sm leading-6 text-slate-700">{{ data_get($approach->content, 'note') }}</div></div><div class="legal-card p-6 lg:col-span-7"><div class="flex items-center justify-between"><p class="text-sm font-semibold">Ecosistema Integrado de Control Jurídico</p><span class="rounded bg-slate-100 px-2 py-1 text-[10px]">SLAD Hub</span></div><div class="mt-6 grid gap-3 sm:grid-cols-2">@foreach(data_get($approach->content, 'items', []) as $item)<div class="flex items-center gap-3 rounded-lg bg-[#edf3ff] p-4"><span class="grid size-9 place-items-center rounded-lg bg-white text-blue-700">✓</span><span class="text-sm font-semibold">{{ $item }}</span></div>@endforeach</div><div class="mt-6 rounded-lg bg-slate-50 p-4"><div class="flex justify-between text-[10px] font-semibold text-slate-500"><span>Eficacia en el seguimiento procesal</span><span>Flujo centralizado</span></div><svg viewBox="0 0 500 70" class="mt-3 h-16 w-full" preserveAspectRatio="none"><path d="M0 55 C80 50 105 40 155 44 S250 10 320 28 S420 58 500 20" fill="none" stroke="#2563eb" stroke-width="3"/><path d="M0 60H500" stroke="#dbeafe"/></svg></div></div></div></section>
    @endif

    @if ($cta)<x-site.cta :section="$cta" />@endif
</x-site.layout>
