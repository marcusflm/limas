<div>
    <x-header :title="$usuario->nome" subtitle="Dados do usuario" separator>
        <x-slot:actions>
            <x-button icon="o-pencil" class="btn-primary" @click="$wire.myModal = true" />
        </x-slot>
    </x-header>
    <x-modal wire:model="myModal" title="Editar usuario">
        <livewire:usuario.usuario-edit :$usuario />
    </x-modal>
    <div class="mx-auto md:w-3/5 lg:w-1/2">
        <x-card shadow>
            <x-input label="Nome" :value="$nome" readonly />
            <br />
            <x-input label="E-mail" :value="$email" readonly />
            <br />
        </x-card>
    </div>
    <br />
</div>
