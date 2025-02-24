<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario; // Importação do modelo Usuario
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Exibe uma lista de clientes com paginação e filtro de pesquisa.
     */
    public function index(Request $request)
    {
        // Filtro de pesquisa
        $pesquisa = $request->input('pesquisa');

        // Busca os clientes com paginação e aplica o filtro de pesquisa, se existir
        $clientes = Cliente::when($pesquisa, function ($query, $pesquisa) {
            return $query->where('nome', 'like', "%$pesquisa%")
                         ->orWhere('email', 'like', "%$pesquisa%");
        })->paginate(10); // Paginação de 10 registros por página

        // Retorna a view 'clientes.index' com os clientes
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Exibe o formulário para criar um novo cliente.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Armazena um novo cliente no banco de dados.
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'required|regex:/^\(\d{2}\) \d{5}-\d{4}$/',
            'cep' => 'required|regex:/^\d{5}-\d{3}$/',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
        ]);

        // Cria o cliente no banco de dados
        Cliente::create($request->all());

        // Redireciona para a lista de clientes com uma mensagem de sucesso
        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um cliente específico.
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Exibe o formulário para editar um cliente existente.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Atualiza um cliente no banco de dados.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefone' => 'required|string|max:20',
            'cep' => 'required|string|max:10',
            'endereco' => 'required|string|max:255',
        ]);

        // Atualiza o cliente no banco de dados
        $cliente->update($request->all());

        // Redireciona para a lista de clientes com uma mensagem de sucesso
        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Exclui um cliente do banco de dados.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'Erro ao excluir o cliente. Por favor, tente novamente.');
        }
    }
    
    /**
     * Exibe uma lista de usuários com paginação e filtro de pesquisa.
     */
    public function listarUsuarios(Request $request)
    {
        $pesquisa = $request->input('pesquisa');

        $usuarios = Usuario::when($pesquisa, function ($query) use ($pesquisa) {
            return $query->where('name', 'like', "%{$pesquisa}%")
                         ->orWhere('email', 'like', "%{$pesquisa}%");
        })->paginate(10); // Adicionando paginação

        return view('clientes.usuarios', compact('usuarios'));
    }
}
