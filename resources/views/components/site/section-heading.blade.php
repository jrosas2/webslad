@props(['eyebrow' => null, 'title', 'subtitle' => null, 'centered' => false])
<div @class(['max-w-3xl', 'mx-auto text-center' => $centered])>
    @if ($eyebrow)<p class="eyebrow">{{ $eyebrow }}</p>@endif
    <h2 class="mt-3 text-3xl font-bold tracking-tight text-slad-navy lg:text-4xl">{{ $title }}</h2>
    @if ($subtitle)<p class="mt-4 text-base leading-7 text-slate-600">{{ $subtitle }}</p>@endif
</div>
