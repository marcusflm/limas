<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIMA's confeitaria caseira</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200">
    <x-main>
        @auth
        <x-slot:sidebar class="bg-[#c58a25] text-white strong" drawer="main-drawer" collapsible collapse-text="Recolher">

            <!-- Hidden when collapsed -->
            <a href="/">
                <div class="mx-3 my-5">
                    <img src="{{ asset('images/logo3.jpeg') }}" width="70" class="rounded-full mx-auto" />
                </div>
            </a>

            @if($user = auth()->user())
            <x-list-item :item="$user" value="nome" sub-value="nenhum" no-separator no-hover class="border-y border-y-base-300">
                <x-slot:actions>
                    <div class="tooltip tooltip-left" data-tip="logoff">
                        <a href="/logout" class="btn btn-ghost btn-circle btn-sm"><x-icon name="o-power" /></a>
                    </div>
                </x-slot:actions>
            </x-list-item>
            @endif

            <x-menu class="lg:mt-4" activate-by-route active-bg-color="bg-base-300/10">
                <x-menu-item title="Pedidos" icon="o-plus-circle" link="/pedidos" />
                <x-menu-item title="Produtos" icon="o-heart" link="/produtos" />
                <x-menu-item title="Categorias" icon="o-cake" link="/categorias" />
                <x-menu-item title="Clientes" icon="o-users" link="/clientes" />
                <x-menu-item title="Bairros" icon="o-home" link="/bairros" />
                <x-menu-item title="Lotes" icon="o-tag" link="###" />
            </x-menu>
        </x-slot:sidebar>
        @endauth

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>

</html>