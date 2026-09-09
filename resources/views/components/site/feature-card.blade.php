@props(['title', 'description', 'tag' => null, 'dark' => false])
<article {{ $attributes->class([$dark ? 'border-white/10 bg-[#102653] text-white' : 'legal-card text-slad-navy', 'p-6']) }}>
    <div @class(['mb-5 flex size-10 items-center justify-center rounded-lg', 'bg-blue-100 text-blue-700' => ! $dark, 'bg-white/10 text-blue-200' => $dark])>
        <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m12 3 7 4v5c0 4.4-2.8 7.7-7 9-4.2-1.3-7-4.6-7-9V7l7-4Z"/><path d="m9 12 2 2 4-4"/></svg>
    </div>
    @if ($tag)<p class="data-label mb-2 {{ $dark ? 'text-blue-200' : '' }}">{{ $tag }}</p>@endif
    <h3 class="text-lg font-semibold">{{ $title }}</h3>
    <p @class(['mt-2 text-sm leading-6', 'text-slate-600' => ! $dark, 'text-slate-300' => $dark])>{{ $description }}</p>
    {{ $slot }}
</article>
