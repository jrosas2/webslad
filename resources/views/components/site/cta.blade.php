@props(['section'])
<section class="site-section bg-slad-navy text-white">
    <div class="site-container flex flex-col items-start justify-between gap-8 md:flex-row md:items-center">
        <div class="max-w-3xl">
            @if(data_get($section->content, 'eyebrow'))<p class="eyebrow text-blue-300">{{ data_get($section->content, 'eyebrow') }}</p>@endif
            <h2 class="mt-3 text-3xl font-bold tracking-tight lg:text-4xl">{{ $section->title }}</h2>
            <p class="mt-4 max-w-2xl leading-7 text-slate-300">{{ $section->subtitle }}</p>
        </div>
        <a href="{{ route('contacto') }}" class="primary-button shrink-0">{{ data_get($section->content, 'button', 'Solicitar demostración') }} <span aria-hidden="true">→</span></a>
    </div>
</section>
