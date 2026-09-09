<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-slate-50">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-slate-200 bg-white">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('admin.dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group heading="Administración" class="grid">
                    <flux:sidebar.item icon="home" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="document-text" :href="route('admin.pages.edit', 'home')" :current="request()->is('admin/contenido/home/*')">Contenido · Home</flux:sidebar.item>
                    <flux:sidebar.item icon="document-text" :href="route('admin.pages.edit', 'producto')" :current="request()->is('admin/contenido/producto/*')">Contenido · Producto</flux:sidebar.item>
                    <flux:sidebar.item icon="document-text" :href="route('admin.pages.edit', 'nosotros')" :current="request()->is('admin/contenido/nosotros/*')">Contenido · Nosotros</flux:sidebar.item>
                    <flux:sidebar.item icon="document-text" :href="route('admin.pages.edit', 'contacto')" :current="request()->is('admin/contenido/contacto/*')">Contenido · Contacto</flux:sidebar.item>
                    <flux:sidebar.item icon="photo" :href="route('admin.media.index')" :current="request()->routeIs('admin.media.*')">Multimedia</flux:sidebar.item>
                    <flux:sidebar.item icon="inbox" :href="route('admin.contacts.index')" :current="request()->routeIs('admin.contacts.*')">Solicitudes</flux:sidebar.item>
                    <flux:sidebar.item icon="cog-6-tooth" :href="route('admin.settings.edit')" :current="request()->routeIs('admin.settings.*')">Configuración</flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="arrow-top-right-on-square" :href="route('home')" target="_blank">
                    Ver sitio
                </flux:sidebar.item>
            </flux:sidebar.nav>

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="border-b border-slate-200 bg-white lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            Mi cuenta
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            Cerrar sesión
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
