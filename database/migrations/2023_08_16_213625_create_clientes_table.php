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
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',100);
            $table->string('telefone',100);
            $table->string('email',100);
            $table->integer('bairro_id')->unsigned();

            $table->timestamps();

            $table->foreign("bairro_id")->references('id')->on('bairros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
