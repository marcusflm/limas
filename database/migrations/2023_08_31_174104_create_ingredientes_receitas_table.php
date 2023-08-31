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
        Schema::create('ingredientes_receitas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ingrediente_id')->unsigned();
            $table->decimal('quantidade', 10, 2);
            $table->integer('receita_id')->unsigned();
            $table->timestamps();

            $table->foreign("receita_id")->references('id')->on('receitas')->onDelete('cascade');
            $table->foreign("ingrediente_id")->references('id')->on('ingredientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredientes_receitas');
    }
};
