<div class="flex justify-center">
    <div class="w-1/3">
        <x-card title="Nova categoria" shadow separator>
            <x-form wire:submit="save">
                <x-input label="Nome" wire:model="nome" required />
                <x-slot:actions>
                    <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>