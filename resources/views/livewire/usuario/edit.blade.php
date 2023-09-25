<x-form wire:submit="save">
    <x-input label="Nome" :value="$nome" readonly />
    <x-input label="E-mail" :value="$email" readonly />
    <x-input label="Senha" wire:model="password" type="password" />
    <x-slot:actions>
        <x-button label="Cancelar" wire:click="$dispatch('usuario-edicao-concluida')" />
        <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
    </x-slot>
</x-form>
