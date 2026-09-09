@props(['compact' => false])
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-3']) }}>
    <span class="flex size-9 items-center justify-center rounded-lg bg-slad-navy text-white shadow-sm" aria-hidden="true">
        <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M12 3 5.5 5.6v5.6c0 4.2 2.6 7.9 6.5 9.8 3.9-1.9 6.5-5.6 6.5-9.8V5.6L12 3Z" />
            <path d="M9 10.2h6M12 7.5v7.2M9.7 14.8h4.6" />
        </svg>
    </span>
    <span class="flex flex-col leading-none">
        <span class="text-lg font-bold tracking-tight">SLAD</span>
        @unless ($compact)
            <span class="mt-1 hidden text-[9px] font-medium tracking-wide text-slate-500 sm:block">Sistema Logístico de Administración de Derecho</span>
        @endunless
    </span>
</span>
