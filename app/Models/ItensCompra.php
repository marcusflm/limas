<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensCompra extends Model
{
    use HasFactory;

    protected $fillable = ['ingrediente_id', 'valor_unitario', 'quantidade', 'compra_id'];
}
