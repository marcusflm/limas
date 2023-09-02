<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lote extends Model
{
    use HasFactory;

    protected $fillable = ['quantidade', 'produto_id', 'compra_id', 'custo_unitario', 'custo_lote'];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}
