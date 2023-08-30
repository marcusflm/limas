<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bairro;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\StatusPagamento;
use App\Models\StatusPedido;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        StatusPedido::insert([
            [
                'nome' => 'Aberto',
                'botao' => 'btn-outline btn-primary',
                'icone' => 'o-lock-open'
            ],
            [
                'nome' => 'Fechado',
                'botao' => 'bg-primary text-white',
                'icone' => 'o-lock-closed'
            ]
        ]);

        StatusPagamento::insert([
            [
                'nome' => 'Pendente',
                'botao' => 'btn-outline btn-error',
                'badge' => 'badge-error'

            ],
            [
                'nome' => 'Pago',
                'botao' => 'bg-success text-white',
                'badge' => 'badge-success'
            ]
        ]);

        Bairro::insert([
            [
                'nome' => 'Cruzeiro',
                'frete' => 0
            ],
            [
                'nome' => 'Guará',
                'frete' => 10
            ], [
                'nome' => 'Águas Claras',
                'frete' => 15
            ]
        ]);

        Cliente::insert([
            [
                'nome' => 'Marcus',
                'telefone' => '61981672368',
                'email' => 'marcus@gmail.com',
                'bairro_id' => 2
            ],
            [
                'nome' => 'Pedro',
                'telefone' => '61981326822',
                'email' => 'pedro@gmail.com',
                'bairro_id' => 1
            ],
            [
                'nome' => 'Cláudio',
                'telefone' => '61996069048',
                'email' => 'claudio@gmail.com',
                'bairro_id' => 3
            ]
        ]);

        Categoria::insert([
            [
                'nome' => 'Palha italiana'
            ],
            [
                'nome' => 'Brownie'
            ]
        ]);

        Produto::insert([
            [
                'nome' => 'Tradicional',
                'valor' => 8,
                'categoria_id' => 1
            ],
            [
                'nome' => 'Tradicional granulado',
                'valor' => 10,
                'categoria_id' => 1
            ],
            [
                'nome' => '70%',
                'valor' => 10,
                'categoria_id' => 1
            ],
            [
                'nome' => '100%',
                'valor' => 11,
                'categoria_id' => 1
            ],
            [
                'nome' => 'Oreo com ninho',
                'valor' => 10,
                'categoria_id' => 1
            ],
            [
                'nome' => 'Oreo com ninho (Biscoito por fora)',
                'valor' => 10,
                'categoria_id' => 1
            ]
        ]);

        User::insert(
            [
                'nome' => 'Nome Teste',
                'email' => 'teste@teste.com',
                'password' => Hash::make('12345')
            ]
        );
        //\App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
