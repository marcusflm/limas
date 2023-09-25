<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\StatusPagamento;
use App\Models\StatusPedido;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        StatusPedido::insert([
            [
                'nome' => 'Aberto',
                'botao' => 'btn-outline btn-primary',
                'icone' => 'o-lock-open',
            ],
            [
                'nome' => 'Fechado',
                'botao' => 'bg-primary text-white',
                'icone' => 'o-lock-closed',
            ],
        ]);

        StatusPagamento::insert([
            [
                'nome' => 'Pendente',
            ],
            [
                'nome' => 'Pago',
            ],
        ]);

        Categoria::insert([
            [
                'nome' => 'Palha italiana',
            ],
            [
                'nome' => 'Brownie',
            ],
        ]);

        Produto::insert([
            [
                'nome' => 'Tradicional',
                'valor' => 8,
                'categoria_id' => 1,
            ],
            [
                'nome' => 'Tradicional granulado',
                'valor' => 10,
                'categoria_id' => 1,
            ],
            [
                'nome' => '70%',
                'valor' => 10,
                'categoria_id' => 1,
            ],
            [
                'nome' => '100%',
                'valor' => 11,
                'categoria_id' => 1,
            ],
            [
                'nome' => 'Oreo com ninho',
                'valor' => 10,
                'categoria_id' => 1,
            ],
            [
                'nome' => 'Oreo com ninho (Biscoito por fora)',
                'valor' => 10,
                'categoria_id' => 1,
            ],
        ]);

        User::insert(
            [
                'nome' => 'Nome Teste',
                'email' => 'teste@teste.com',
                'password' => Hash::make('12345'),
            ]
        );
    }
}
