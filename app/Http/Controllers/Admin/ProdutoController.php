<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\CrudTraitController;

use App\Models\Produto;
use Exception;

class ProdutoController extends Controller
{

    private $model;

    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    use CrudTraitController;

    public function index(){

        return view('admin.produtos');
    }

     /**
     * metedo adaptado para usar com auto-complete
     */
    public function getProdutosPorNome($nome){

        try{

            $lista = $this->model->select('id','nome','valor')->where('nome', 'like', "%$nome%")->paginate();

            return response()->json($lista, 200);

        }catch(Exception $e){

            return response()->json(['errors' => formataExcecao($e)], 400);
        }

    }
}
