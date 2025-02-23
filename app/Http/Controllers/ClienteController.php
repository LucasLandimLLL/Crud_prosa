<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Exibe uma lista de clientes.
     */
    public function index(Request $request)
    {
        // Validação do campo de pesquisa
        $request->validate([
            'pesquisa' => 'nullable|string',
        ], [
            'pesquisa.string' => 'Por favor, insira um termo válido para a pesquisa.',
        ]);
    
        // Verifica se foi fornecido um termo de pesquisa
        if ($request->has('pesquisa') && $request->pesquisa != '') {
            // Usando whereRaw para ignorar acentuação e buscar no nome e email
            $clientes = Cliente::whereRaw('LOWER(nome) LIKE ? OR LOWER(email) LIKE ?', [
                '%' . preg_replace('/[^A-Za-z0-9]/', '', strtolower($request->pesquisa)) . '%',
                '%' . preg_replace('/[^A-Za-z0-9]/', '', strtolower($request->pesquisa)) . '%'
            ])->get();
    
            // Se não encontrar nenhum cliente, exibe uma lista vazia
            if ($clientes->isEmpty()) {
                return view('clientes.index', ['clientes' => collect(), 'message' => 'Nenhum cliente encontrado.']);
            }
        } else {
            // Se não houver filtro, exibe todos os clientes
            $clientes = Cliente::all();
        }
    
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

public function destroy(Cliente $cliente)
{
    try {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    } catch (\Exception $e) {
        return redirect()->route('clientes.index')->with('error', 'Erro ao excluir o cliente. Por favor, tente novamente.');
    }

    }
    
}
