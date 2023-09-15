<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bairro;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Ingrediente;
use App\Models\IngredientesReceita;
use App\Models\ItensCompra;
use App\Models\Mercado;
use App\Models\Produto;
use App\Models\Receita;
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
                'nome' => 'Pendente'
            ],
            [
                'nome' => 'Pago'
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

        Mercado::insert(
            [
                'nome' => 'Assaí'
            ]
        );

        Ingrediente::insert([
            [
                'nome' => 'Leite condensado'
            ],
            [
                'nome' => 'Chocolate em pó'
            ],
            [
                'nome' => 'Manteiga'
            ],
            [
                'nome' => 'Biscoito'
            ]
        ]);

        Receita::insert([
            [
                'produto_id' => 1
            ]
        ]);

        IngredientesReceita::insert([
            [
                'receita_id' => 1,
                'ingrediente_id' => 1,
                'quantidade' => 1580
            ],
            [
                'receita_id' => 1,
                'ingrediente_id' => 2,
                'quantidade' => 120
            ],
            [
                'receita_id' => 1,
                'ingrediente_id' => 3,
                'quantidade' => 36
            ],
            [
                'receita_id' => 1,
                'ingrediente_id' => 4,
                'quantidade' => 200
            ]
        ]);

        Compra::insert([
            [
                'mercado_id' => 1,
                'data_compra' => '2023-08-31',
                'valor_total' => 63.28
            ]
        ]);

        ItensCompra::insert([
            [
                'compra_id' => 1,
                'ingrediente_id' => 1,
                'valor_unitario' => 7.68,
                'peso' => 395,
                'quantidade' => 4
            ],
            [
                'compra_id' => 1,
                'ingrediente_id' => 2,
                'valor_unitario' => 26.90,
                'peso' => 1000,
                'quantidade' => 1
            ],
            [
                'compra_id' => 1,
                'ingrediente_id' => 3,
                'valor_unitario' => 23.5,
                'peso' => 500,
                'quantidade' => 1
            ],
            [
                'compra_id' => 1,
                'ingrediente_id' => 4,
                'valor_unitario' => 5.2,
                'peso' => 200,
                'quantidade' => 1
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
