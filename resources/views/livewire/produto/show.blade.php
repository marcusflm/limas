<div>
    <x-header :title="$produto->nome" subtitle="Dados do produto" separator>
        <x-slot:actions>
            <x-button icon="o-pencil" class="btn-primary" title="Editar" @click="$wire.myModal = true" />
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal" title="Editar produto">
        <livewire:produto.produto-edit :$produto />
    </x-modal>
    <div class="mx-auto lg:w-1/2 md:w-3/5">
        <x-card shadow>
            <x-input label="Nome" :value="$nome" readonly /><br>
            <x-input label="Categoria" :value="$produto->categoria->nome" readonly /><br>
            <div class="w-1/2 lg:w-2/5">
                <x-input label="Valor" wire:model="valor" prefix="R$" thousands-separator="." fraction-separator="," money readonly />
            </div><br>
            <x-input label="Descrição" wire:model="descricao" readonly />
        </x-card>
    </div>
    <br>
    <div class="grid grid-cols-2 gap-4 mx-auto lg:w-1/2 flex-row md:w-3/5">
        <div>
            <x-card title="Unidades vendidas">
                {{$total_unidades_vendidas}}
            </x-card>
        </div>
        <div>
            <x-card title="Valor total">
                R$ {{ number_format($valor_total_unidades_vendidas, 2, ',', '.') }}
            </x-card>
        </div>
    </div>
</div>