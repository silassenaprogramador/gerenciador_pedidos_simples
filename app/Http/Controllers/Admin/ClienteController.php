<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\CrudTraitController;

use App\Models\Cliente;
use Exception;

class ClienteController extends Controller
{

    private $model;

    public function __construct(Cliente $cliente)
    {
        $this->model = $cliente;
    }

    use CrudTraitController;

    public function index(){

        return view('admin.clientes');
    }

    /**
     * metedo adaptado para usar com auto-complete
     */
    public function getClientesPorNome($nome){

        try{

            $lista = $this->model->select('id','nome')->where('nome', 'like', "%$nome%")->paginate();

            return response()->json($lista, 200);

        }catch(Exception $e){

            return response()->json(['errors' => formataExcecao($e)], 400);
        }

    }
}
