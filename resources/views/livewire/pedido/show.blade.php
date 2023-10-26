<div>
    <x-header title="Pedido {{$pedido->id}}" subtitle="Cliente: {{$pedido->cliente->nome}}" separator>
        <x-slot:actions>
            {{-- @if ($pedido->itensPedido()->count() > 0 && $pedido->isAberto()) --}}
            @if ($pedido->itensPedido()->count() > 0)
                <x-button
                    wire:click="alterar_status_pedido"
                    label="{{ $pedido->isAberto() ? 'Fechar pedido' : 'Pedido fechado' }}"
                    icon="{{ $pedido->status_pedido->icone }}"
                    class="btn + {{ $pedido->status_pedido->botao }}"
                />
            @endif

            {{-- @if ($pedido->isAberto()) --}}
                <x-button icon="o-plus" class="btn-primary" @click="$wire.myModal = true" />
            {{-- @endif --}}
        </x-slot>
    </x-header>

    <x-modal wire:model="myModal" title="Novo item">
        <livewire:pedido.pedido-item-create :$pedido />
    </x-modal>

    @if ($pedido->itensPedido()->count() > 0)
        <livewire:pedido.pedido-item-list :$pedido />
        <br />
        <div class="justify-end gap-3 lg:flex">
            <x-card>
                @if ($pedido->isAberto())
                    <x-input label="Desconto" wire:model="valor_desconto" thousands-separator="." fraction-separator="," money />
                @else
                    <x-input label="Desconto" wire:model="valor_desconto" thousands-separator="." fraction-separator="," money readonly />
                @endif
            </x-card>
            <br />
            <x-card>
                <x-input label="Frete" wire:model="valor_frete" thousands-separator="." fraction-separator="," money readonly />
            </x-card>
            <br />
            <x-card>
                <x-input label="Total itens" wire:model="valor_itens" thousands-separator="." fraction-separator="," money readonly />
            </x-card>
            <br />
            <x-card>
                <x-input label="Total do pedido" wire:model="valor_total" thousands-separator="." fraction-separator="," money readonly />
            </x-card>
        </div>
        <br />
        <div>
            <x-card>
                <x-textarea
                    wire:model="observacao"
                    placeholder="Observação"
                    hint="Shift+Enter ou Tab para salvar..."
                    wire:keydown.shift.enter="grava_observacao"
                    wire:keydown.tab="grava_observacao"
                    rows="3"
                    inline />
            </x-card>
        </div>
    @else
        <x-card>
            <x-alert icon="o-user" title="Pedido vazio!" />
        </x-card>
    @endif
</div>
