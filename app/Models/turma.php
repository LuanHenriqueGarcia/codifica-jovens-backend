<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'link_aula',
        'data_inicio',
        'data_fim',
    ];

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'aluno_turma');
    }
}
