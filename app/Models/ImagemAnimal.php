<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagemAnimal extends Model
{
    use HasFactory;

    protected $table = 'imagens_animais';

    protected $fillable = ['url'];
}
