<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'valor', 'descricao', 'categoria_id'];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItensPedido::class);
    }

    public function receita(): BelongsTo
    {
        return $this->belongsTo(Receita::class);
    }
}
