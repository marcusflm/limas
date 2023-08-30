<div>
    <x-header :title="$cliente->nome" subtitle="Dados do cliente" separator>
        <x-slot:actions>
            <x-button icon="o-pencil" class="btn-primary" @click="$wire.myModal = true" />
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal" title="Editar cliente">
        <livewire:cliente.cliente-edit :$cliente />
    </x-modal>
    <div class="mx-auto lg:w-1/2 md:w-3/5">
        <x-card shadow>
            <x-input label="Nome" :value="$nome" readonly /><br>
            <x-input label="Telefone" :value="$telefone" x-mask="(99) 9 9999-9999" readonly /><br>
            <x-input label="E-mail" :value="$email" readonly /><br>
            <x-input label="Bairro" :value="$cliente->bairro->nome" readonly />
        </x-card>
    </div>
    <br>

    @if($pedidos->count() > 0)
    <x-card>
        <x-table :headers="$headers" :rows="$pedidos" striped @row-click="$wire.navegar('/pedidos/' + $event.detail.id)">
            @scope('cell_data_pedido', $pedido)
            {{ $pedido->data_pedido->format('d/m/Y') }}
            @endscope

            @scope('cell_valor_total', $pedido)
            {{ number_format($pedido->valor_total, 2, ',', '.') }}
            @endscope
        </x-table>
    </x-card>
    @else
    <x-card>
        <x-alert icon="o-user" title="Não há pedidos para este cliente." />
    </x-card>
    @endif
</div>