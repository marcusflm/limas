<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bairro;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\StatusPagamento;
use App\Models\StatusPedido;
use Faker\Core\Number;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        StatusPedido::insert([
            [
                'nome' => 'Aberto'
            ],
            [
                'nome' => 'Fechado'
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
                'nome' => 'Chocolate 70%',
                'valor' => 11,
                'descricao' => 'Com chocolate nestle',
                'categoria_id' => 1
            ],
            [
                'nome' => 'Ninho trufado',
                'valor' => 10,
                'descricao' => 'cremoso',
                'categoria_id' => 1
            ]
        ]);
        // DB::table('users')->insert([
        //     'name'=>Str::random(10),
        //     'email'=> Str::random(10),'@gmail.com',
        //     'password'=>Hash::make('password'),
        // ]);
        //\App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}