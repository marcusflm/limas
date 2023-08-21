<div class="flex justify-center">
    <div class="w-1/3">
        <x-card title="Novo item" shadow separator>
            <x-form wire:submit="save">
                <x-select label="Produto" wire:model="produto_id" placeholder="Selecione.." :options="$produtos" option-value="id" option-label="nome" />
                <x-input label="Quantidade" wire:model="quantidade" x-mask="99" required />
                <x-slot:actions>
                    <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>