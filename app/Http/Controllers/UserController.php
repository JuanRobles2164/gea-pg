<?php ?>

namespace App\Http\Controllers;

use App\Models\User;
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
    public function index()
    {
        //
    }

    public function listar(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = UserRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
    }

    public function details(Request $request){
        $num_rows = $request->cantidad != null ? $request->cantidad : 15;
        $this->repo = UserRepository::GetInstance();
        $lista = $this->repo->getAll($num_rows);
        $this->repo = null;
        return json_encode($lista);
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

    public function store(Request $request)
    {
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRolRequest  $request
     * @param  \App\Models\Rol  $Rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->repo = UserRepository::GetInstance();
        $data = $request->all();
        $user = $this->repo->find($data["id"]);
        $this->repo->update($user, $data);
        $this->repo = null;
        return json_encode($user);
    }

    public function destroy(Request $user)
    {
        $objeto = new User($user->all());
        $objeto->id = $user->id;
        $this->repo = UserRepository::GetInstance();
        $objeto = $this->repo->find($objeto->id);
        $this->repo->delete($objeto);
        $this->repo = null;
        return json_encode($objeto);
    }
}
