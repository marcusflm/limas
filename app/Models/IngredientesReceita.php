<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IngredientesReceita extends Model
{
    use HasFactory;

    protected $fillable = ['ingrediente_id', 'quantidade', 'receita_id'];

    public function receita(): BelongsTo
    {
        return $this->belongsTo(Receita::class);
    }

    public function ingrediente(): BelongsTo
    {
        return $this->belongsTo(Ingrediente::class);
    }
}
