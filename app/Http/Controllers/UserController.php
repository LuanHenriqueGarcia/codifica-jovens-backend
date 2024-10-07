<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Método para listar todos os usuários
    public function index()
    {
        $users = User::all(); // Obtém todos os usuários do banco de dados
        return response()->json($users); // Retorna os usuários em formato JSON
    }

    // Método para criar um novo usuário
    public function store(StoreUserRequest $request)
    {
        // Cria um novo usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, Response::HTTP_CREATED); // Retorna o usuário criado com status 201
    }

    // Método para obter um usuário específico
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($user); // Retorna o usuário encontrado
    }

    // Método para atualizar um usuário existente
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }

        // Atualiza o usuário
        $user->update($request->only(['name', 'email', 'password']));

        return response()->json($user); // Retorna o usuário atualizado
    }

    // Método para excluir um usuário
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $user->delete();

        return response()->json(['message' => 'Usuário deletado']); // Retorna mensagem de sucesso
    }
 
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {

            /** @var \App\Models\User $user **/

            $user = Auth::user();

            $token = $user->createToken('LaravelAuthApp');

            return response()->json([
                'token' => [$user,$token],
            ], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Credenciais inválidas'], Response::HTTP_UNAUTHORIZED);
        }
    }



}
