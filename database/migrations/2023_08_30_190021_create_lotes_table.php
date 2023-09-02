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
        Schema::create('lotes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade');
            $table->integer('compra_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->decimal('custo_unitario', 10, 2);
            $table->decimal('custo_lote', 10, 2);

            $table->timestamps();

            $table->foreign("compra_id")->references('id')->on('compras')->onDelete('cascade');
            $table->foreign("produto_id")->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};
