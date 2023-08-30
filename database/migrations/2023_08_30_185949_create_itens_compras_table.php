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
        Schema::create('itens_compras', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('valor_unitario', 10, 2)->default(0);
            $table->integer('quantidade');
            $table->integer('ingrediente_id')->unsigned();
            $table->integer('compra_id')->unsigned();

            $table->timestamps();

            $table->foreign("ingrediente_id")->references('id')->on('ingredientes')->onDelete('cascade');
            $table->foreign("compra_id")->references('id')->on('compras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_compras');
    }
};
