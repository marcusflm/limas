<div>
    <x-header :title="$bairro->nome" subtitle="Editar dados do bairro" separator />
    <div class="w-1/2 mx-auto">
        <x-card shadow>
            <x-form wire:submit="save" class="p-5">
                <x-input label="Nome" wire:model="nome" readonly />
                <div class="w-2/5">
                    <x-input label="Valor Frete" wire:model="frete" prefix="R$" thousands-separator="." fraction-separator="," money required />
                </div>
                <x-slot:actions>
                    <x-button label="Cancelar" wire:click="navegar('/bairros')" />
                    <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>