<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\User;
use App\Repositories\RolUsuario\RolUsuarioRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $criterio = $request->criterio;
        $this->repo = UserRepository::GetInstance();
        $lista = $this->repo->getAllPersonalizado($criterio);
        $this->repo = null;
        $allData = ['users' => $lista];
        return view('users.main_menu', $allData);
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = UserRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $this->repo = UserRepository::GetInstance();
        $obj = $this->repo->find($request->id);
        $this->repo = null;

        $this->repo = RolUsuarioRepository::GetInstance();
        $roles = $this->repo->findByParams(['usuario' => $request->id]);

        $allData = ['user' => $obj,
                    'roles' => $roles];
        return json_encode($allData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function toggleUserState(Request $request){
        $this->repo = UserRepository::GetInstance();
        $usuario = $this->repo->toggleState($request->id);
        $this->repo = null;
        return json_encode($usuario);
    }

    public function resetPassword(Request $request){
        $this->repo = UserRepository::GetInstance();
        $usuario = $this->repo->resetPassword($request->id);
        $this->repo = null;
        return json_encode(
            ["status" => "ok",
            "mensaje" => "Se ha restablecido la contraseña con éxito",
            "entidad" => $usuario
            ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'identificacion' => 'required',
            'password' => ['required', 'confirmed']
        ]);
        $this->repo = UserRepository::GetInstance();
        $data = $request->all();
        $data["password"] = Hash::make($data["password"]);
        if(isset($data["confirm_password"])){
            unset($data["confirm_password"]);
        }
        $data = $this->repo->create($data);
        $this->repo = null;
        return json_encode($data);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3' ], 
            'email' => ['required', 'email'],
            'identificacion' => 'required'
        ]);
        
        $this->repo = UserRepository::GetInstance();
        $data = $request->all();
        $user = $this->repo->find($data["id"]);
        if(!isset($data['password'])){
            $data['password'] = $user->password;
        }else{
            $request->validate([
                'password' => 'confirmed'
            ]);
            $data['password'] = Hash::make($data['password']);
        }
        $user = $this->repo->update($user, $data);
        $this->repo = null;
        return json_encode($user);
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        $retorno = [];
        $retorno['roles_usuario'] = [];
        $this->repo = RolUsuarioRepository::GetInstance();
        $roles_usuario = $this->repo->findByUser($data["id"]);
        foreach($roles_usuario as $ru){
            $dataRolesUsr = [
                'id' => $ru->id,
                'usuario' => $data['id'],
                'rol' => $ru->rol,
                'estado' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ];
            array_push($retorno['roles_usuario'], $this->repo->update($ru, $dataRolesUsr));
        }
        $this->repo = null;

        $this->repo = UserRepository::GetInstance();
        $usuario = $this->repo->find($data["id"]);
        $dataUsuario = [
            'id' => $data["id"],
            'name' => $usuario->name,
            'email' => $usuario->email,
            'email_verified_at' => $usuario->email_verified_at,
            'password' => $usuario->password,
            'identificacion' => $usuario->identificacion,
            'estado' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $this->repo->update($usuario, $dataUsuario);
        $this->repo = null;
        $retorno['usuario'] = $usuario;
        return json_encode($retorno);
    }
}
