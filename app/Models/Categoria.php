<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Produto;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function produto()
    {
        return $this->hasMany(Produto::class, 'categoria_id', 'id');
    }
}
