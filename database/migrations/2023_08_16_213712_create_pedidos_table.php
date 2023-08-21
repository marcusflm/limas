<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->datetime('data_pedido');
            $table->decimal('valor_itens', 10, 2)->default(0);
            $table->decimal('valor_frete', 10, 2);
            $table->decimal('valor_desconto', 10, 2)->default(0);
            $table->decimal('valor_total', 10, 2);
            $table->integer('status_pedido_id')->unsigned()->default(1);
            $table->integer('status_pagamento_id')->unsigned()->default(1);

            $table->timestamps();

            $table->foreign("cliente_id")->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign("status_pedido_id")->references('id')->on('status_pedidos')->onDelete('cascade');
            $table->foreign("status_pagamento_id")->references('id')->on('status_pagamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
