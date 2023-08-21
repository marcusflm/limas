<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'valor_itens', 'valor_frete', 'valor_desconto', 'valor_total', 'data_pedido', 'status_pedido_id', 'status_pagamento_id'];

    protected $casts = [
        'data_pedido' => 'datetime:Y-m-d',
    ];

    public function itensPedido(): HasMany
    {
        return $this->hasMany(ItensPedido::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function status_pedido(): BelongsTo
    {
        return $this->belongsTo(StatusPedido::class);
    }

    public function status_pagamento(): BelongsTo
    {
        return $this->belongsTo(StatusPagamento::class);
    }
}
