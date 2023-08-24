<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bairro extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'frete'];

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class);
    }
}
