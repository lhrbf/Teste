<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'valor', 'data_deposito'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}