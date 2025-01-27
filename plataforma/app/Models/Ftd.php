<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ftd extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'descricao', 'valor', 'data_ftd'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
