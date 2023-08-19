<div class="flex justify-center">
    <div class="w-1/3">
        <x-card title="Novo item" shadow separator>
            <x-form wire:submit="save">
                <x-select label="Produto" placeholder="Selecione.." :options="$produtos" option-value="id" option-label="nome" wire:model="produto_id" />
                <x-input label="Quantidade" x-mask="99" wire:model="quantidade" required />
                <x-slot:actions>
                    <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>