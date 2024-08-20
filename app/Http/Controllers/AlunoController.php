<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::all();
        return response()->json($alunos, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email',
            'telefone' => 'nullable|string|max:20',
        ]);

        $aluno = Aluno::create($request->all());
        return response()->json($aluno, 201);
    }

    public function show($id)
    {
        $aluno = Aluno::findOrFail($id);
        return response()->json($aluno, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email,' . $id,
            'telefone' => 'nullable|string|max:20',
        ]);

        $aluno = Aluno::findOrFail($id);
        $aluno->update($request->all());

        return response()->json($aluno, 200);
    }

    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->turmas()->detach();
        $aluno->delete();

        return response()->json(null, 204);
    }
}
