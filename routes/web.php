<?php

use App\Livewire\Bairro\BairroCreate;
use App\Livewire\Bairro\BairroIndex;
use App\Livewire\Bairro\BairroEdit;
use Illuminate\Support\Facades\Route;

use App\Livewire\Categoria\CategoriaCreate;
use App\Livewire\Categoria\CategoriaEdit;
use App\Livewire\Categoria\CategoriaIndex;
use App\Livewire\Cliente\ClienteCreate;
use App\Livewire\Cliente\ClienteIndex;
use App\Livewire\Cliente\ClienteEdit;
use App\Livewire\Index;
use App\Livewire\Pedido\PedidoCreate;
use App\Livewire\Pedido\PedidoIndex;
use App\Livewire\Pedido\PedidoItemIndex;
use App\Livewire\Pedido\PedidoItemCreate;
use App\Livewire\Produto\ProdutoCreate;
use App\Livewire\Produto\ProdutoEdit;
use App\Livewire\Produto\ProdutoIndex;

Route::get('/', Index::class);
Route::get('/pedidos', PedidoIndex::class);
Route::get('/pedidos/create', PedidoCreate::class);
Route::get('/pedidos/{pedido}/itens', PedidoItemIndex::class);
Route::get('/pedidos/{pedido}/itens/create', PedidoItemCreate::class);

Route::get('/produtos', ProdutoIndex::class);
Route::get('/produtos/create', ProdutoCreate::class);
Route::get('/produtos/{produto}', ProdutoEdit::class);

Route::get('/categorias', CategoriaIndex::class);
Route::get('/categorias/create', CategoriaCreate::class);
Route::get('/categorias/{categoria}', CategoriaEdit::class);

Route::get('/clientes', ClienteIndex::class);
Route::get('/clientes/create', ClienteCreate::class);
Route::get('/clientes/{cliente}', ClienteEdit::class);

Route::get('/bairros', BairroIndex::class);
Route::get('/bairros/create', BairroCreate::class);
Route::get('/bairros/{bairro}', BairroEdit::class);
