<x-site.layout :page="$page" :settings="$settings">
    @php
        $hero = $sections->get('contacto.hero');
        $formSection = $sections->get('contacto.form');
        $information = $sections->get('contacto.information');
        $cta = $sections->get('contacto.cta');
        $needValues = ['causas', 'actuaciones', 'documentos', 'recordatorios', 'gestion-financiera', 'importacion-excel', 'otro'];
    @endphp

    <section class="dot-grid bg-slad-canvas py-14 lg:py-20">
        <div class="site-container">
            @if($hero)
                <p class="eyebrow">{{ data_get($hero->content, 'eyebrow') }}</p>
                <h1 class="mt-4 max-w-4xl text-4xl font-bold tracking-[-0.035em] lg:text-5xl">{{ $hero->title }}</h1>
                <p class="mt-5 max-w-3xl text-base leading-7 text-slate-600">{{ $hero->subtitle }}</p>
            @endif

            @if(session('contact_success'))
                <div class="mt-8 rounded-xl border border-emerald-200 bg-emerald-50 p-5 text-sm font-semibold text-emerald-800" role="status">✓ {{ session('contact_success') }}</div>
            @endif

            <div class="mt-12 grid items-start gap-8 lg:grid-cols-12">
                @if($formSection)
                    <div class="legal-card p-6 lg:col-span-7 lg:p-8">
                        <h2 class="text-2xl font-semibold">{{ $formSection->title }}</h2><p class="mt-2 text-sm text-slate-600">{{ $formSection->subtitle }}</p>
                        <form method="POST" action="{{ route('contacto.store') }}" class="mt-8" onsubmit="this.querySelector('button[type=submit]').disabled=true">
                            @csrf
                            <input type="hidden" name="submission_token" value="{{ $submissionToken }}">
                            <div class="hidden" aria-hidden="true"><label for="website">Sitio web</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div><label for="name" class="text-sm font-medium">Nombre completo <span class="text-red-600">*</span></label><input id="name" name="name" value="{{ old('name') }}" required autocomplete="name" class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm focus:border-blue-500 focus:ring-3 focus:ring-blue-100" placeholder="Ej. Mauricio Valenzuela">@error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                                <div><label for="company" class="text-sm font-medium">Empresa / Organización <span class="text-red-600">*</span></label><input id="company" name="company" value="{{ old('company') }}" required autocomplete="organization" class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm focus:border-blue-500 focus:ring-3 focus:ring-blue-100" placeholder="Ej. Gerencia Legal">@error('company')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                                <div><label for="position" class="text-sm font-medium">Cargo</label><input id="position" name="position" value="{{ old('position') }}" autocomplete="organization-title" class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm" placeholder="Ej. Abogado Senior"></div>
                                <div><label for="email" class="text-sm font-medium">Correo institucional <span class="text-red-600">*</span></label><input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm" placeholder="nombre@organizacion.com">@error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                                <div><label for="phone" class="text-sm font-medium">Teléfono de contacto</label><input id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel" class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm" placeholder="+56 9 1234 5678"></div>
                                <div><label for="estimated_users" class="text-sm font-medium">Cantidad aproximada de usuarios</label><select id="estimated_users" name="estimated_users" class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm"><option value="">Seleccione un rango</option>@foreach(['1-5' => '1–5 usuarios', '6-15' => '6–15 usuarios', '16-50' => '16–50 usuarios', '51+' => 'Más de 50 usuarios'] as $value => $label)<option value="{{ $value }}" @selected(old('estimated_users') === $value)>{{ $label }}</option>@endforeach</select></div>
                            </div>
                            <fieldset class="mt-6"><legend class="text-sm font-medium">¿Qué necesita gestionar? <span class="font-normal text-slate-500">(Opcional)</span></legend><div class="mt-3 grid gap-2 sm:grid-cols-2 lg:grid-cols-3">@foreach(data_get($formSection->content, 'needs', []) as $index => $label)<label class="flex cursor-pointer items-center gap-2 rounded-lg bg-[#edf3ff] px-3 py-2 text-xs"><input type="checkbox" name="needs[]" value="{{ $needValues[$index] }}" @checked(in_array($needValues[$index], old('needs', []), true)) class="rounded border-slate-400 text-blue-700">{{ $label }}</label>@endforeach</div></fieldset>
                            <div class="mt-6"><label for="message" class="text-sm font-medium">Mensaje o detalle específico <span class="text-red-600">*</span></label><textarea id="message" name="message" rows="5" required class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm" placeholder="Describa brevemente el volumen de casos, dolores del flujo o plazos...">{{ old('message') }}</textarea>@error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                            <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center"><button type="submit" class="primary-button min-w-56 disabled:cursor-wait disabled:opacity-60">Solicitar demostración <span aria-hidden="true">→</span></button><p class="text-xs leading-5 text-slate-600">✓ {{ data_get($formSection->content, 'privacy') }}</p></div>
                        </form>
                    </div>
                @endif

                @if($information)
                    <aside class="space-y-4 lg:col-span-5">
                        <article class="legal-card p-5"><p class="data-label text-blue-700">Canales escritos directos</p><p class="mt-3 text-sm font-semibold">{{ $settings['contact_email'] ?? data_get($information->content, 'email_sales') }}</p><p class="mt-1 text-sm">{{ $settings['support_email'] ?? data_get($information->content, 'email_support') }}</p></article>
                        <article class="legal-card p-5"><p class="data-label text-blue-700">Línea telefónica corporativa</p><p class="mt-3 text-xl font-semibold">{{ $settings['phone'] ?? data_get($information->content, 'phone') }}</p><p class="mt-1 text-xs text-slate-600">{{ $settings['business_hours'] ?? data_get($information->content, 'hours') }}</p></article>
                        <article class="legal-card p-5"><p class="data-label text-blue-700">Oficina central y despliegue</p><p class="mt-3 text-xl font-semibold">{{ $settings['location'] ?? data_get($information->content, 'location') }}</p><p class="mt-1 text-xs text-slate-600">{{ data_get($information->content, 'coverage') }}</p></article>
                        <div class="relative h-48 overflow-hidden rounded-xl bg-slate-300"><div class="absolute inset-0 bg-[linear-gradient(35deg,transparent_45%,rgba(30,64,175,.3)_46%_50%,transparent_51%),linear-gradient(-25deg,transparent_47%,rgba(255,255,255,.7)_48%_51%,transparent_52%)] bg-[length:90px_70px]"></div><div class="absolute inset-x-4 bottom-4 rounded-lg bg-slad-deep/90 p-3 text-xs font-semibold text-white">⌖ Distrito corporativo Santiago · Conexión cloud multi-región</div></div>
                        <article class="rounded-xl bg-[#e8efff] p-5"><p class="data-label text-blue-700">Protocolo de confidencialidad</p><p class="mt-3 text-sm leading-6 text-slate-700">{{ data_get($information->content, 'confidentiality') }}</p></article>
                    </aside>
                @endif
            </div>
        </div>
    </section>

    @if($cta)
        <section class="site-section bg-white"><div class="site-container"><div class="rounded-xl bg-slad-deep p-8 text-white lg:p-12"><div class="grid items-center gap-8 lg:grid-cols-12"><div class="lg:col-span-7"><p class="eyebrow text-blue-300">{{ data_get($cta->content, 'eyebrow') }}</p><h2 class="mt-3 text-3xl font-bold">{{ $cta->title }}</h2><p class="mt-4 leading-7 text-slate-300">{{ $cta->subtitle }}</p></div><div class="flex flex-wrap gap-2 lg:col-span-5">@foreach(data_get($cta->content, 'items', []) as $item)<span class="rounded-lg bg-white/10 px-4 py-3 text-xs">{{ $item }}</span>@endforeach</div></div></div></div></section>
    @endif
</x-site.layout>
