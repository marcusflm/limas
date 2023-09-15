<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Bairro\BairroIndex;
use App\Livewire\Categoria\CategoriaIndex;
use App\Livewire\Cliente\ClienteIndex;
use App\Livewire\Cliente\ClienteShow;
use App\Livewire\Compra\CompraIndex;
use App\Livewire\Compra\CompraShow;
use App\Livewire\Index;
use App\Livewire\Ingrediente\IngredienteIndex;
use App\Livewire\Login;
use App\Livewire\Lote\LoteIndex;
use App\Livewire\Mercado\MercadoIndex;
use App\Livewire\Pedido\PedidoIndex;
use App\Livewire\Pedido\PedidoItemCreate;
use App\Livewire\Pedido\PedidoShow;
use App\Livewire\Produto\ProdutoIndex;
use App\Livewire\Produto\ProdutoShow;
use App\Livewire\Receita\ReceitaIndex;
use App\Livewire\Receita\ReceitaShow;

Route::get('/login', Login::class)->name('login');

Route::get('/logout', function () {
    auth()->logout();

    return redirect()->route('login');
});


Route::middleware('auth')->group(function () {
    Route::get('/', Index::class);

    Route::get('/pedidos', PedidoIndex::class);
    Route::get('/pedidos/{pedido}', PedidoShow::class);
    Route::get('/pedidos/{pedido}/itens/create', PedidoItemCreate::class);

    Route::get('/produtos', ProdutoIndex::class);
    Route::get('/produtos/{produto}', ProdutoShow::class);

    Route::get('/categorias', CategoriaIndex::class);

    Route::get('/clientes', ClienteIndex::class);
    Route::get('/clientes/{cliente}', ClienteShow::class);

    Route::get('/bairros', BairroIndex::class);

    Route::get('/lotes', LoteIndex::class);

    Route::get('/compras', CompraIndex::class);
    Route::get('/compras/{compra}', CompraShow::class);

    Route::get('/receitas', ReceitaIndex::class);
    Route::get('/receitas/{receita}', ReceitaShow::class);

    Route::get('/ingredientes', IngredienteIndex::class);
    Route::get('/mercados', MercadoIndex::class);
});
