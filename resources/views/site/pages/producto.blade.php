<x-site.layout :page="$page" :settings="$settings">
    @php
        $hero = $sections->get('producto.hero');
        $cases = $sections->get('producto.cases');
        $actions = $sections->get('producto.actions');
        $responsibles = $sections->get('producto.responsibles');
        $documents = $sections->get('producto.documents');
        $reminders = $sections->get('producto.reminders');
        $finances = $sections->get('producto.finances');
        $dashboard = $sections->get('producto.dashboard');
        $audit = $sections->get('producto.audit');
        $permissions = $sections->get('producto.permissions');
        $import = $sections->get('producto.import');
        $multicompany = $sections->get('producto.multicompany');
        $security = $sections->get('producto.security');
        $cta = $sections->get('producto.cta');
    @endphp

    @if ($hero)
        <section class="dot-grid bg-white py-14 lg:py-20">
            <div class="site-container">
                <p class="eyebrow">{{ data_get($hero->content, 'eyebrow') }}</p>
                <h1 class="mt-4 max-w-4xl text-4xl font-bold tracking-[-0.035em] text-slad-navy lg:text-5xl">{{ $hero->title }}</h1>
                <p class="mt-5 max-w-3xl text-base leading-7 text-slate-600">{{ $hero->subtitle }}</p>
                <div class="mt-9 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach (data_get($hero->content, 'pillars', []) as $pillar)
                        <div class="legal-card flex items-center gap-3 px-4 py-3 text-sm font-semibold"><span class="grid size-8 place-items-center rounded-lg bg-blue-50 text-blue-700">✓</span>{{ $pillar }}</div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($cases)
        <section class="site-section bg-slad-canvas">
            <div class="site-container">
                <x-site.section-heading eyebrow="Núcleo operacional" :title="$cases->title" :subtitle="$cases->subtitle" />
                <div class="mt-10 grid gap-6 lg:grid-cols-12">
                    <div class="legal-card overflow-hidden lg:col-span-7">
                        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 p-4"><div class="flex gap-2"><span class="rounded-md bg-blue-50 px-3 py-2 text-xs text-blue-700">Buscar causa...</span><span class="rounded-md border border-slate-200 px-3 py-2 text-xs">Civil (18)</span></div><span class="text-xs text-slate-500">128 causas</span></div>
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[620px] text-left text-xs">
                                <thead class="bg-slate-50 text-[10px] tracking-wider text-slate-500 uppercase"><tr><th class="p-4">Rol</th><th class="p-4">Carátula</th><th class="p-4">Estado</th><th class="p-4 text-right">Monto</th></tr></thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach (data_get($cases->content, 'rows', []) as $row)
                                        <tr class="hover:bg-blue-50/40"><td class="p-4 font-semibold text-blue-700">{{ $row['rol'] }}</td><td class="p-4 font-medium">{{ $row['name'] }}</td><td class="p-4"><span class="rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-semibold text-emerald-700">{{ $row['status'] }}</span></td><td class="p-4 text-right tabular-nums">{{ $row['amount'] }}</td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <aside class="rounded-xl bg-slad-navy p-6 text-white lg:col-span-5">
                        <p class="text-[10px] font-bold tracking-widest text-blue-300 uppercase">Ficha de causa seleccionada</p>
                        <div class="mt-4 flex items-start justify-between gap-4"><div><p class="text-sm text-blue-200">C-1234-2025</p><h3 class="mt-1 text-xl font-semibold">Banco Andino c/ Comercial SpA</h3></div><span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs text-emerald-300">Vigente</span></div>
                        <dl class="mt-6 grid grid-cols-2 gap-4 text-xs"><div><dt class="text-slate-400">Materia</dt><dd class="mt-1 font-medium">Civil / Ejecutivo</dd></div><div><dt class="text-slate-400">Tribunal</dt><dd class="mt-1 font-medium">1° Juzgado Civil</dd></div><div><dt class="text-slate-400">Responsable</dt><dd class="mt-1 font-medium">A. Valenzuela</dd></div><div><dt class="text-slate-400">Monto</dt><dd class="mt-1 font-medium">$45.000.000</dd></div></dl>
                        <div class="mt-6"><div class="flex justify-between text-xs"><span>Progreso procesal</span><span>Etapa 4 de 6</span></div><div class="mt-2 h-2 rounded-full bg-white/10"><div class="h-2 w-2/3 rounded-full bg-blue-500"></div></div></div>
                    </aside>
                </div>
            </div>
        </section>
    @endif

    @if ($actions || $responsibles)
        <section class="site-section bg-[#edf3ff]">
            <div class="site-container grid gap-8 lg:grid-cols-12">
                @if ($actions)
                    <div class="lg:col-span-7"><x-site.section-heading :title="$actions->title" :subtitle="$actions->subtitle" /><div class="legal-card mt-7 p-6"><ol class="space-y-6 border-l-2 border-blue-100 pl-6">@foreach(data_get($actions->content, 'items', []) as $item)<li class="relative"><span class="absolute -left-[31px] top-1 size-3 rounded-full border-2 border-white bg-blue-600"></span><p class="data-label text-blue-700">{{ $item['date'] }}</p><h3 class="mt-1 text-sm font-semibold">{{ $item['title'] }}</h3><p class="mt-1 text-xs leading-5 text-slate-600">{{ $item['description'] }}</p></li>@endforeach</ol></div></div>
                @endif
                @if ($responsibles)
                    <div class="lg:col-span-5"><x-site.section-heading :title="$responsibles->title" :subtitle="$responsibles->subtitle" /><div class="legal-card mt-7 divide-y divide-slate-100 p-5">@foreach(data_get($responsibles->content, 'items', []) as $item)<div class="flex items-center gap-4 py-4 first:pt-0 last:pb-0"><span class="grid size-11 place-items-center rounded-full bg-blue-100 font-bold text-blue-700">{{ str($item['name'])->substr(0, 1) }}</span><div class="min-w-0 flex-1"><p class="truncate text-sm font-semibold">{{ $item['name'] }}</p><p class="text-xs text-slate-500">{{ $item['role'] }}</p></div><span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium">{{ $item['count'] }}</span></div>@endforeach</div></div>
                @endif
            </div>
        </section>
    @endif

    @if ($documents || $reminders)
        <section class="site-section bg-white">
            <div class="site-container grid gap-8 lg:grid-cols-2">
                @foreach ([$documents, $reminders] as $block)
                    @if ($block)
                        <div><x-site.section-heading :title="$block->title" :subtitle="$block->subtitle" /><div class="mt-7 space-y-3">@foreach(data_get($block->content, 'items', []) as $item)<article class="legal-card flex items-start gap-4 p-4"><span class="grid size-10 shrink-0 place-items-center rounded-lg bg-blue-50 text-blue-700">{{ $block === $documents ? 'PDF' : '!' }}</span><div><p class="text-xs font-semibold text-blue-700">{{ $item['meta'] ?? $item['when'] }}</p><h3 class="mt-1 text-sm font-semibold">{{ $item['name'] ?? $item['title'] }}</h3>@if(isset($item['description']))<p class="mt-1 text-xs leading-5 text-slate-600">{{ $item['description'] }}</p>@endif</div></article>@endforeach</div></div>
                    @endif
                @endforeach
            </div>
        </section>
    @endif

    @if ($finances)
        <section class="site-section bg-slad-canvas">
            <div class="site-container"><x-site.section-heading eyebrow="Control de gastos e ingresos" :title="$finances->title" :subtitle="$finances->subtitle" /><div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">@foreach(data_get($finances->content, 'metrics', []) as $metric)<div class="legal-card p-5"><p class="data-label">{{ $metric['label'] }}</p><p class="mt-3 text-2xl font-bold tabular-nums">{{ $metric['value'] }}</p><div class="mt-4 h-1.5 rounded-full bg-blue-100"><div class="h-1.5 w-2/3 rounded-full bg-blue-600"></div></div></div>@endforeach</div><div class="legal-card mt-5 overflow-hidden"><div class="border-b border-slate-100 p-4 text-sm font-semibold">Últimos movimientos imputados</div><div class="grid grid-cols-4 gap-2 p-4 text-xs"><span>10/09/2026</span><span>C-1234-2025</span><span>Receptor judicial</span><span class="text-right text-red-600">− $450.000</span><span>08/09/2026</span><span>O-4609-2026</span><span>Acuerdo conciliatorio</span><span class="text-right text-emerald-600">+ $8.200.000</span></div></div></div>
        </section>
    @endif

    @if ($dashboard)
        <section class="site-section bg-[#edf3ff]">
            <div class="site-container"><x-site.section-heading eyebrow="Inteligencia gerencial" :title="$dashboard->title" :subtitle="$dashboard->subtitle" /><div class="mt-8 grid gap-5 lg:grid-cols-3"><div class="legal-card p-6"><p class="data-label">Estado de causas</p><div class="mt-5 flex gap-5">@foreach(data_get($dashboard->content, 'metrics', []) as $metric)<div><p class="text-2xl font-bold">{{ $metric['value'] }}</p><p class="mt-1 text-[10px] text-slate-500">{{ $metric['label'] }}</p></div>@endforeach</div></div><div class="legal-card p-6"><p class="data-label">Distribución por materia</p><div class="mt-6 flex h-28 items-end justify-around gap-3"><span class="h-4/5 w-8 rounded-t bg-blue-700"></span><span class="h-3/5 w-8 rounded-t bg-blue-500"></span><span class="h-2/5 w-8 rounded-t bg-blue-300"></span><span class="h-1/4 w-8 rounded-t bg-blue-200"></span></div></div><div class="legal-card p-6"><p class="data-label">Carga del equipo</p><div class="mt-5 space-y-4">@foreach(data_get($dashboard->content, 'workload', []) as $item)<div><div class="flex justify-between text-xs"><span>{{ $item['name'] }}</span><span>{{ $item['value'] }}%</span></div><div class="mt-1 h-2 rounded-full bg-slate-100"><div class="h-2 rounded-full bg-blue-600" style="width: {{ $item['value'] }}%"></div></div></div>@endforeach</div></div></div></div>
        </section>
    @endif

    @if ($audit)
        <section class="site-section bg-white">
            <div class="site-container"><x-site.section-heading eyebrow="Seguridad y cumplimiento" :title="$audit->title" :subtitle="$audit->subtitle" /><div class="legal-card mt-8 overflow-x-auto"><table class="w-full min-w-[720px] text-left text-xs"><thead class="bg-slate-50 text-[10px] tracking-wider text-slate-500 uppercase"><tr><th class="p-4">Fecha y hora</th><th class="p-4">Usuario</th><th class="p-4">Causa</th><th class="p-4">Modificación</th></tr></thead><tbody class="divide-y divide-slate-100">@foreach(data_get($audit->content, 'rows', []) as $row)<tr><td class="p-4 font-mono text-slate-500">{{ $row['date'] }}</td><td class="p-4 font-medium">{{ $row['user'] }}</td><td class="p-4 text-blue-700">{{ $row['matter'] }}</td><td class="p-4">{{ $row['change'] }}</td></tr>@endforeach</tbody></table></div></div>
        </section>
    @endif

    @if ($permissions)
        <section class="site-section bg-slad-canvas">
            <div class="site-container"><x-site.section-heading eyebrow="Control de acceso granular" :title="$permissions->title" :subtitle="$permissions->subtitle" /><div class="mt-8 grid gap-5 lg:grid-cols-3">@foreach(data_get($permissions->content, 'items', []) as $item)<x-site.feature-card :title="$item['title']" :description="$item['description']"><ul class="mt-5 space-y-2 text-xs text-slate-600">@foreach($item['features'] as $feature)<li class="flex gap-2"><span class="text-blue-700">✓</span>{{ $feature }}</li>@endforeach</ul></x-site.feature-card>@endforeach</div></div>
        </section>
    @endif

    @if ($import || $multicompany)
        <section class="site-section bg-[#edf3ff]"><div class="site-container grid gap-6 lg:grid-cols-2">@foreach([$import, $multicompany] as $block)@if($block)<article class="legal-card p-7"><p class="eyebrow">{{ data_get($block->content, 'eyebrow') }}</p><h2 class="mt-3 text-2xl font-bold">{{ $block->title }}</h2><p class="mt-3 text-sm leading-6 text-slate-600">{{ $block->subtitle }}</p>@if(data_get($block->content, 'detail'))<div class="mt-6 rounded-lg bg-slate-50 p-4 text-sm font-semibold">{{ data_get($block->content, 'detail') }} <span class="float-right text-blue-700">⇄</span></div>@else<div class="mt-6 grid grid-cols-2 gap-2">@foreach(data_get($block->content, 'items', []) as $item)<span class="rounded-lg bg-slate-50 p-3 text-xs font-medium">{{ $item }}</span>@endforeach</div>@endif</article>@endif @endforeach</div></section>
    @endif

    @if ($security)
        <section class="site-section bg-white"><div class="site-container"><x-site.section-heading eyebrow="Infraestructura crítica" :title="$security->title" :subtitle="$security->subtitle" /><div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">@foreach(data_get($security->content, 'items', []) as $item)<x-site.feature-card :title="$item['title']" :description="$item['description']" />@endforeach</div></div></section>
    @endif

    @if ($cta)<x-site.cta :section="$cta" />@endif
</x-site.layout>
