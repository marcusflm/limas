<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = ['produto_id'];

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class);
    }

    public function ingredientesReceita(): HasMany
    {
        return $this->hasMany(IngredientesReceita::class);
    }
}
