<?php

namespace App\Http\Controllers;

use App\Models\Licitacion;
use App\Repositories\Licitacion\LicitacionRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->repo = LicitacionRepository::GetInstance();
        $lista = null;
        $lista = $this->repo->getAllEstado();
        $allData = ['licitaciones' => $lista];
        $this->repo = null;
        return view('dashboard', $allData);
    }
}
