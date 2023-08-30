<div class="flex min-h-screen flex-1 mx-auto w-full p-5 lg:p-10">
    <x-card class="mx-auto my-auto">
        <img src="{{ asset('images/logo3.jpeg') }}" width="170" class="absolute mt-[-160px] ml-[65px] rounded-full bg-transparent" />
        <x-form wire:submit="autenticar">
            <x-input label="E-mail" wire:model="email" placeholder="email@example.com" icon="m-at-symbol" required />
            <x-input label="Senha" wire:model="password" placeholder="senha" type="password" icon="o-eye" required />
            <x-slot:actions>
                <x-button label="Login" class="btn-primary w-full" type="submit" spinner="autenticar" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>