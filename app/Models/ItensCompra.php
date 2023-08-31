<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItensCompra extends Model
{
    use HasFactory;

    protected $fillable = ['ingrediente_id', 'valor_unitario', 'quantidade', 'compra_id'];

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class);
    }

    public function ingrediente(): BelongsTo
    {
        return $this->belongsTo(Ingrediente::class);
    }
}
