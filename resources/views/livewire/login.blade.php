<div class="mx-auto lg:w-1/3">
    <x-card>
        <x-form wire:submit="autenticar">
            <x-input label="E-mail" wire:model="email" placeholder="email@example.com" required />
            <x-input label="Senha" wire:model="senha" placeholder="senha" type="password" icon="o-eye" required />
            <x-slot:actions>
                <x-button label="Entrar" class="btn-primary" type="submit" spinner="autenticar" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>