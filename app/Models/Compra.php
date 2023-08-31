<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['data_compra', 'valor_total', 'mercado_id'];

    protected $casts = [
        'data_compra' => 'datetime:Y-m-d',
    ];

    public function mercado(): BelongsTo
    {
        return $this->belongsTo(Mercado::class);
    }

    public function itensCompra(): HasMany
    {
        return $this->hasMany(ItensCompra::class);
    }
}
