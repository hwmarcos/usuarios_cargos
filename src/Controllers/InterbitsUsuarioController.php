<?php

namespace Helderwmarcos\Interbits\Controllers;

use App\Http\Controllers\Controller;
use Helderwmarcos\Interbits\Requests\ClienteRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use Helderwmarcos\Interbits\Models\InterbitsUsuario;
use Helderwmarcos\Interbits\Models\InterbitsCargo;

class InterbitsUsuarioController extends Controller
{
    /**
     * Listando todos os usuários
     *
     * São listados 10 registros por página
     *
     * @return mixed
     */
    public function index()
    {
        $usuarios = InterbitsUsuario::orderby('id', 'desc')->paginate(10);
        return view('interbits::usuario.index', compact('usuarios'));
    }

    /**
     * Filtrando usuários
     *
     * Fazendo a filtro por nome, cargo e/ou celular
     * Mostrando os 10 primeiros registros encontrados
     *
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $where = [];
        $usuarios = [];
        foreach ($request->all() as $key => $value) {
            if (!empty($value) && $key != '_token') {
                $where[$key] = $value;
            }
        }
        if (count($where)) {
            $usuarios = InterbitsUsuario::where($where)->paginate(10);
        }
        if (count($usuarios)) {
            return view('interbits::usuario.index', compact('usuarios'));
        } else {
            return redirect('interbits/usuarios')->with('error', 'Nenhum registro encontrado.');
        }
    }

    /**
     * Mostrando o formulário de edição
     *
     * Formulário de cadastro ou alteração de dados
     *
     * @param null $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $cargos = $this->cargos();
        $usuario = !is_null($id) ? $this->find($id) : null;
        return view('interbits::usuario.edit', compact('usuario', 'cargos'));
    }

    /**
     * Salvando registro
     *
     * Verificando se irá inserir ou alterar um registro
     *
     * @param Request $request
     * @return mixed
     */
    public function save(ClienteRequest $request)
    {
        return $request->id > 0 ? $this->update($request->id, $request) : $this->insert($request);
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
        $usuario = InterbitsUsuario::findOrFail($id);
        $usuario->delete($id);
        return redirect('interbits/usuarios')->with('success', 'Registro removido com sucesso.');
    }

    /**
     * Editando a senha do usuário
     *
     * Mostrar formulário de alteração de senha
     *
     * @param $id
     * @return mixed
     */
    public function edit_password($id)
    {
        return view('interbits::usuario.edit_password', compact('id'));
    }

    /**
     * Alteração de senha
     *
     * Validando os dados recebidos
     * Alterando a senha do usuário
     *
     * @param Request $request
     * @return mixed
     */
    public function save_password(Request $request)
    {
        $this->validatePassword($request);
        $data = $this->prepareData($request->all());
        $usuario = InterbitsUsuario::findOrFail($request->id);
        $usuario->update($data);
        return redirect('interbits/usuarios')->with('success', 'Senha alterada com sucesso.');
    }

    /**
     * Preparando os dados
     *
     * Recebendo os dados e encriptando a senha com bcrypt
     * Retornando um array com os dados tratrando com trim
     *
     * @param $request
     * @return array
     */
    private function prepareData($request)
    {
        foreach ($request as $key => $value) {
            $data[$key] = $key == 'senha' ? bcrypt(trim($value)) : trim($value);
        }
        return $data;
    }

    /**
     * Valida senha e confirma senha
     *
     * Validando apenas os campos senha e confirma senha
     * vindos do formulário de edição
     *
     * @param $request
     */
    private function validatePassword($request)
    {
        $this->validate($request, [
            'senha' => 'required|min:8|max:15',
            'confirma' => 'required|same:senha'
        ]);
    }

    /**
     * Buscando o usuário
     *
     * Fazendo a busca do usuário do banco de dados pelo ID
     * @param $id
     * @return mixed
     */
    private function find($id)
    {
        return InterbitsUsuario::findOrFail($id);
    }

    /**
     * Cadastrando um registro
     *
     * Fazendo as validações de formulário
     * Verificando se o email é único no banco de dados
     * Persistindo os dados no banco dedos
     * Retornando as mensagens de sucesso ou erro
     *
     * @param $request
     * @return mixed
     */
    private function insert($request)
    {
        $this->validatePassword($request);
        $data = $this->prepareData($request->all());
        InterbitsUsuario::create($data);
        return redirect('interbits/usuarios')->with('success', 'Dados salvos com sucesso.');
    }

    /**
     * Alterando registro
     *
     * Fazendo as validações de formulário
     * Verificando se o email é único no banco de dados
     * Persistindo os dados no banco de dados
     * Retornando a mensagem de sucesso ou erro
     *
     * @param $id
     * @param $request
     * @return mixed
     */
    private function update($id, $request)
    {
        $usuario = InterbitsUsuario::findOrFail($id);
        $data = $this->prepareData($request->all());
        $usuario->update($data);
        return redirect('interbits/usuarios')->with('success', 'Dados alterados com sucesso.');
    }

    /**
     * Selecionando todos os cargos
     *
     * Selecionando todos os cargos para popular o combo
     * no formulário de edição do usuário
     *
     * @return mixed
     */
    private function cargos()
    {
        $cargos = InterbitsCargo::orderby('nome', 'asc')->get();
        $data = [];
        if (count($cargos) > 0) {
            foreach ($cargos as $cargo) {
                $data[$cargo->id] = $cargo->nome;
            }
        }
        return $data;
    }

}
