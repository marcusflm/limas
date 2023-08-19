<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Bairros;
use App\Livewire\CadastraBairro;
use App\Livewire\CadastraCategoria;
use App\Livewire\CadastraCliente;
use App\Livewire\CadastraItensPedido;
use App\Livewire\CadastraPedido;
use App\Livewire\CadastraProduto;
use App\Livewire\Clientes;
use App\Livewire\Categorias;
use App\Livewire\ItensPedidos;
use App\Livewire\Pedidos;
use App\Livewire\Produtos;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', Pedidos::class);
Route::get('/pedidos', Pedidos::class);
Route::get('/pedidos/cadastrar', CadastraPedido::class);

Route::get('/itens-pedido/{pedido}', ItensPedidos::class);
Route::get('/itens-pedido/{pedido}/cadastrar', CadastraItensPedido::class);

Route::get('/clientes', Clientes::class);
Route::get('/clientes/cadastrar', CadastraCliente::class);

Route::get('/bairros', Bairros::class);
Route::get('/bairros/cadastrar', CadastraBairro::class);

Route::get('/categorias', Categorias::class);
Route::get('/categorias/cadastrar', CadastraCategoria::class);

Route::get('/produtos', Produtos::class);
Route::get('/produtos/cadastrar', CadastraProduto::class);
