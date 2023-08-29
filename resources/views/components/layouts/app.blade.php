<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIMA's confeitaria caseira</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200">
    @auth
    {{-- The navbar with `sticky` --}}
    <x-nav sticky>
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <a href="/">
                LIMA's confeitaria caseira
            </a>
        </x-slot:brand>
        <x-slot:actions>
            <a href="/logout">Sair <x-icon name="s-arrow-long-right" /></a>
        </x-slot:actions>
    </x-nav>
    @endauth

    {{-- The main content --}}
    <x-main>
        {{-- It is a sidebar that works also as a drawer at small screens --}}
        {{-- Note `main-drawer` reference here --}}
        @auth
        <x-slot:sidebar class="bg-[#c58a25] text-white strong" drawer="main-drawer">
            <x-menu>
                <x-menu-item title="Pedidos" icon="o-plus-circle" link="/pedidos" class="text-base" />
                <x-menu-item title="Produtos" icon="o-heart" link="/produtos" class="text-base" />
                <x-menu-item title="Categorias" icon="o-cake" link="/categorias" class="text-base" />
                <x-menu-item title="Clientes" icon="o-users" link="/clientes" class="text-base" />
                <x-menu-item title="Bairros" icon="o-home" link="/bairros" class="text-base" />
                <x-menu-item title="Lotes" icon="o-tag" link="###" class="text-base" />
            </x-menu>
        </x-slot:sidebar>
        @endauth

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>

        {{-- Footer area --}}
        <x-slot:footer>
            <hr />
            <div class="p-6">
                Footer
            </div>
        </x-slot:footer>
    </x-main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>

</html>