<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Turma;

use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::with('alunos')->get();
        return response()->json($turmas, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'link_aula' => 'required|url',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);
     

        $turma = Turma::create($request->all());

        if ($request->has('alunos')) {
            $turma->alunos()->sync($request->alunos);
        }

        return response()->json($turma, 201);
    }

    public function show($id)
    {
        $turma = Turma::with('alunos')->findOrFail($id);
        return response()->json($turma, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'link_aula' => 'required|url',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);

        $turma = Turma::findOrFail($id);
        $turma->update($request->all());

        if ($request->has('alunos')) {
            $turma->alunos()->sync($request->alunos);
        }

        return response()->json($turma, 200);
    }

    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->alunos()->detach();
        $turma->delete();

        return response()->json(null, 204);
    }
}
