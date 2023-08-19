<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
</head>
@vite(['resources/css/app.css', 'resources/js/app.js'])

<body class="min-h-screen font-sans antialiased bg-slate-200">

    {{-- The navbar with `sticky` --}}
    <x-nav sticky>
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            Lima's doces

        </x-slot:brand>
        <x-slot:actions>
            <a href="###"><x-icon name="o-envelope" /> Messages</a>
            <a href="###"><x-icon name="o-bell" /> Notifications</a>
        </x-slot:actions>
    </x-nav>

    {{-- The main content --}}
    <x-main>
        {{-- It is a sidebar that works also as a drawer at small screens --}}
        {{-- Note `main-drawer` reference here --}}
        <x-slot:sidebar class="bg-slate-300" drawer="main-drawer">
            <x-menu>
                <x-menu-item title="Pedidos" icon="o-plus-circle" link="/pedidos" />
                <x-menu-item title="Produtos" icon="o-heart" link="/produtos" />
                <x-menu-item title="Categorias" icon="o-cake" link="/categorias" />
                <x-menu-item title="Clientes" icon="s-users" link="/clientes" />
                <x-menu-item title="Bairros" icon="o-home" link="/bairros" />
            </x-menu>
        </x-slot:sidebar>

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
</body>

</html>