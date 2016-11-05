<?php

namespace Helderwmarcos\Interbits\Controllers;

use App\Http\Controllers\Controller;
use App\InterbitsUsuario;
use Illuminate\Http\Request;
use App\Http\Requests;
use Helderwmarcos\Interbits\Models\InterbitsCargo;

class InterbitsCargoController extends Controller
{
    /*
     * Listando todos os cargos
     *
     * São listados 10 registros por página
     *
     */
    public function index()
    {
        $cargos = InterbitsCargo::orderby('id', 'desc')->paginate(10);
        return view('interbits::cargo.index', compact('cargos'));
    }

    /**
     * Filtrando cargos
     *
     * Fazendo o filtro pelo nome dlo cargo
     * Mostrando os 10 primeiros registros encontrados
     *
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $cargos = [];
        if (!empty($request->nome)) {
            $cargos = InterbitsCargo::where('nome', 'like', "%{$request->nome}%")->paginate(10);
        }
        if (count($cargos)) {
            return view('interbits::cargo.index', compact('cargos'));
        } else {
            return redirect('interbits/funcoes')->with('error', 'Nenhum registro encontrado.');
        }
    }

    /**
     * Editando um cargo
     *
     * Mostrando o formulário de cadastro/alteração do cargo
     *
     * @param null $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $cargo = !is_null($id) ? $this->find($id) : null;
        return view('interbits::cargo.edit', compact('cargo'));
    }

    /**
     * Salvando registro
     *
     * Verificando se irá inserir ou alterar um registro
     *
     * @param Request $request
     * @return mixed
     */
    public function save(Request $request)
    {
        $this->validateFields($request);
        $data = $request->all();
        $save = $data['id'] > 0 ? $this->update($data['id'], $data) : $this->insert($data);
        return redirect('interbits/funcoes')->with('success', 'Dados salvos com sucesso.');
    }

    /**
     * Excluindo um registro
     *
     * Fazendo o "softDelete" do registro no banco de dados
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $usuario = InterbitsCargo::findOrFail($id);
        $usuario->delete($id);
        InterbitsUsuario::where(['cargo_id' => $id])->delete();
        return redirect('interbits/funcoes')->with('success', 'Registro removido com sucesso.');
    }

    /**
     * Buscando o cargo
     *
     * Fazendo a busca do cargo do banco de dados pelo ID
     * @param $id
     * @return mixed
     */
    private function find($id = null)
    {
        return InterbitsCargo::findOrFail($id);
    }

    /**
     * Validando o nome do cargo
     *
     * Validando o campo nome do formulário
     * O campo nome deve ser único no banco de dados
     *
     * @param $request
     */
    private function validateFields($request)
    {
        $this->validate($request, [
            'nome' => 'required|unique:interbits_cargos'
        ]);
    }

    /**
     * Cadastrando um registro
     *
     * Persistindo o registro no banco de dados
     *
     * @param $data
     * @return static
     */
    private function insert($data)
    {
        return InterbitsCargo::create($data);
    }

    /**
     * Alterando um registro
     *
     * Persistindo o registro no banco de dados
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    private function update($id, $data)
    {
        $usuario = InterbitsCargo::findOrFail($id);
        return $usuario->update($data);
    }

}
