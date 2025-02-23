<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-9 col-xl-8"> <!-- Ajustado para maior largura em telas grandes -->
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Clientes Cadastrados</h2>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark">
                            🏠 Voltar ao Dashboard
                        </a>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Formulário de Pesquisa -->
                        <form action="{{ route('clientes.index') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="pesquisa" class="form-control @error('pesquisa') is-invalid @enderror" placeholder="Pesquisar por nome ou email" value="{{ request('pesquisa') }}">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="bi bi-search"></i> Pesquisar
                                </button>
                            </div>

                            <!-- Exibe um erro como alerta se o nome ou email forem inválidos -->
                            @error('pesquisa')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>

                        <!-- Botão para Cadastrar Novo Cliente -->
                        <div class="mb-3 text-center">
                            <a href="{{ route('clientes.create') }}" class="btn btn-outline-success">
                                Cadastrar Novo Cliente
                            </a>
                        </div>

                        <!-- Tabela de Clientes -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Número</th>
                                        <th>CEP</th>
                                        <th>Endereço</th>
                                        <th class="text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->nome }}</td>
                                            <td>{{ $cliente->email }}</td>
                                            <td>{{ $cliente->telefone }}</td>
                                            <td>{{ $cliente->numero }}</td>
                                            <td>{{ $cliente->cep }}</td>
                                            <td>{{ $cliente->endereco }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-outline-warning">
                                                    ✏️ 
                                                </a>
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mensagens de Nenhum Cliente Encontrado ou Nenhum Cliente Cadastrado -->
                        @if(request('pesquisa') && $clientes->isEmpty())
                            <div class="alert alert-warning text-center mb-4">
                                Nenhum cliente encontrado com o termo "{{ request('pesquisa') }}".
                            </div>
                            <div class="mb-3 text-center">
                                <a href="{{ route('clientes.index') }}" class="btn btn-outline-info">
                                    🔄 Recarregar Todos os Clientes
                                </a>
                            </div>
                        @endif

                        @if($clientes->isEmpty() && !request('pesquisa'))
                            <div class="alert alert-info text-center mb-4">
                                Não há nenhum cliente cadastrado no sistema.
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS e Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
