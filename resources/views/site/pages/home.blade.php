<x-site.layout :page="$page" :settings="$settings">
    @php
        $hero = $sections->get('home.hero');
        $problem = $sections->get('home.problem');
        $features = $sections->get('home.features');
        $benefits = $sections->get('home.benefits');
        $audience = $sections->get('home.audience');
        $cta = $sections->get('home.cta');
    @endphp

    @if ($hero)
        <section class="relative overflow-hidden bg-white py-14 lg:py-20">
            <div class="absolute inset-0 dot-grid opacity-40 [mask-image:linear-gradient(to_bottom,black,transparent)]"></div>
            <div class="site-container relative grid items-center gap-12 lg:grid-cols-12">
                <div class="lg:col-span-6">
                    <p class="eyebrow">{{ data_get($hero->content, 'eyebrow') }}</p>
                    <h1 class="mt-5 max-w-3xl text-4xl leading-tight font-bold tracking-[-0.035em] text-slad-navy sm:text-5xl lg:text-[3.4rem]">{{ $hero->title }}</h1>
                    <p class="mt-6 max-w-2xl text-base leading-7 text-slate-600 lg:text-lg">{{ $hero->subtitle }}</p>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('contacto') }}" class="primary-button">{{ data_get($hero->content, 'primary_cta') }} <span aria-hidden="true">→</span></a>
                        <a href="{{ route('producto') }}" class="secondary-button">{{ data_get($hero->content, 'secondary_cta') }}</a>
                    </div>
                    <ul class="mt-7 flex flex-wrap gap-x-5 gap-y-2 text-xs font-medium text-slate-500">
                        @foreach (data_get($hero->content, 'trust', []) as $item)
                            <li class="flex items-center gap-1.5"><span class="text-blue-700">✓</span>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="lg:col-span-6">
                    <div class="legal-card relative overflow-hidden p-5 shadow-[0_20px_50px_rgba(15,32,66,0.15)]">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <div class="flex items-center gap-2"><span class="size-2 rounded-full bg-red-400"></span><span class="size-2 rounded-full bg-amber-400"></span><span class="size-2 rounded-full bg-emerald-400"></span><span class="ml-2 text-xs font-semibold">SLAD Legal Console</span></div>
                            <span class="rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-700">EN LÍNEA</span>
                        </div>
                        <div class="mt-5 grid gap-3 sm:grid-cols-3">
                            @foreach (data_get($hero->content, 'metrics', []) as $metric)
                                <div class="rounded-lg border border-slate-200 p-4">
                                    <p class="data-label">{{ $metric['label'] }}</p><p class="mt-2 text-2xl font-bold tabular-nums">{{ $metric['value'] }}</p><p class="mt-1 text-[11px] text-blue-700">{{ $metric['detail'] }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-lg bg-slate-50 p-4">
                                <p class="text-xs font-semibold">Distribución de materias</p>
                                <div class="mt-4 flex items-center gap-5">
                                    <div class="grid size-20 place-items-center rounded-full bg-[conic-gradient(#2563eb_0_45%,#60a5fa_45%_73%,#93c5fd_73%_91%,#dbeafe_91%)]"><div class="grid size-12 place-items-center rounded-full bg-white text-xs font-bold">212</div></div>
                                    <div class="space-y-2 text-[11px] text-slate-600"><p>● Civil 45%</p><p>● Laboral 28%</p><p>● Comercial 18%</p><p>● Tributario 9%</p></div>
                                </div>
                            </div>
                            <div class="rounded-lg bg-slate-50 p-4">
                                <p class="text-xs font-semibold">Actividad reciente</p>
                                <div class="mt-3 space-y-3">
                                    <div class="border-l-2 border-blue-500 pl-3"><p class="text-xs font-medium">Escrito de contestación</p><p class="text-[10px] text-slate-500">Hace 14 minutos</p></div>
                                    <div class="border-l-2 border-blue-300 pl-3"><p class="text-xs font-medium">Audiencia programada</p><p class="text-[10px] text-slate-500">Hace 42 minutos</p></div>
                                    <div class="border-l-2 border-slate-300 pl-3"><p class="text-xs font-medium">Resolución notificada</p><p class="text-[10px] text-slate-500">Hace 2 horas</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between rounded-lg bg-slad-deep px-4 py-3 text-xs text-white"><span>SLAD Enterprise v4.2</span><span class="text-emerald-300">● ISO 27001 Ready</span></div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($problem)
        <section class="site-section bg-slad-canvas">
            <div class="site-container">
                <x-site.section-heading :eyebrow="data_get($problem->content, 'eyebrow')" :title="$problem->title" :subtitle="$problem->subtitle" centered />
                <div class="mt-12 grid gap-6 lg:grid-cols-2">
                    <article class="legal-card p-6 lg:p-8">
                        <div class="flex items-center justify-between"><h3 class="text-xl font-semibold">El desafío actual</h3><span class="rounded-full bg-red-50 px-3 py-1 text-[10px] font-bold text-red-700">MODELO FRAGMENTADO</span></div>
                        <p class="mt-4 text-sm leading-6 text-slate-600">Planillas, correos y carpetas desconectadas generan riesgos para la operación jurídica.</p>
                        <div class="mt-6 grid gap-3 sm:grid-cols-2">
                            @foreach (data_get($problem->content, 'problems', []) as $item)
                                <div class="rounded-lg bg-red-50/70 p-4"><h4 class="text-sm font-semibold">{{ $item['title'] }}</h4><p class="mt-1 text-xs leading-5 text-slate-600">{{ $item['description'] }}</p></div>
                            @endforeach
                        </div>
                    </article>
                    <article class="rounded-xl bg-slad-navy p-6 text-white shadow-xl lg:p-8">
                        <div class="flex items-center justify-between"><h3 class="text-xl font-semibold">La solución SLAD</h3><span class="rounded-full bg-blue-600 px-3 py-1 text-[10px] font-bold">CONTROL UNIFICADO</span></div>
                        <div class="mt-6 space-y-3">
                            @foreach (data_get($problem->content, 'solutions', []) as $item)
                                <div class="rounded-lg border border-white/10 bg-black/15 p-4"><h4 class="text-sm font-semibold">{{ $item['title'] }}</h4><p class="mt-1 text-xs leading-5 text-slate-300">{{ $item['description'] }}</p></div>
                            @endforeach
                        </div>
                    </article>
                </div>
            </div>
        </section>
    @endif

    @if ($features)
        <section class="site-section bg-[#edf3ff]">
            <div class="site-container">
                <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <x-site.section-heading :eyebrow="data_get($features->content, 'eyebrow')" :title="$features->title" :subtitle="$features->subtitle" />
                    <a href="{{ route('producto') }}" class="secondary-button shrink-0">Ver todas las funcionalidades</a>
                </div>
                <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach (data_get($features->content, 'items', []) as $item)
                        <x-site.feature-card :title="$item['title']" :description="$item['description']" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($benefits)
        <section class="site-section bg-white">
            <div class="site-container">
                <x-site.section-heading :eyebrow="data_get($benefits->content, 'eyebrow')" :title="$benefits->title" :subtitle="$benefits->subtitle" centered />
                <div class="mt-10 grid gap-x-8 gap-y-7 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach (data_get($benefits->content, 'items', []) as $item)
                        <article class="border-l-2 border-blue-100 pl-4"><div class="flex size-8 items-center justify-center rounded-lg bg-blue-50 text-blue-700">✓</div><h3 class="mt-4 text-sm font-semibold">{{ $item['title'] }}</h3><p class="mt-2 text-xs leading-5 text-slate-600">{{ $item['description'] }}</p></article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($audience)
        <section class="site-section bg-[#edf3ff]">
            <div class="site-container">
                <x-site.section-heading :eyebrow="data_get($audience->content, 'eyebrow')" :title="$audience->title" :subtitle="$audience->subtitle" centered />
                <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach (data_get($audience->content, 'items', []) as $item)
                        <x-site.feature-card :tag="$item['tag']" :title="$item['title']" :description="$item['description']" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($cta)<x-site.cta :section="$cta" />@endif
</x-site.layout>
