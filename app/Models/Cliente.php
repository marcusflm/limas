<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'telefone', 'email', 'bairro_id'];

    public function bairro(): BelongsTo
    {
        return $this->belongsTo(Bairro::class);
    }
}
