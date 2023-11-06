<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adocao extends Model
{
    use HasFactory;

    protected $table = 'adocaos';

    protected $fillable = [
        'animal_id',
        'nome_solicitante',
        'cpf',
        'email',
        'celular',
        'data_nascimento',
    ];

    // Define a relação com a tabela 'animais'
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}
