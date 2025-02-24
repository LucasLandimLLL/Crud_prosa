<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="mb-4">
            <a href="/dashboard" class="px-4 py-2 text-white bg-black border border-black rounded hover:bg-gray-700 transition">
                🏠 Voltar ao Dashboard
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-4">Lista de Usuários</h1>

        <!-- Campo de Busca -->
        <form action="{{ route('usuarios.index') }}" method="GET" class="mb-4">
            <div class="flex">
                <input type="text" name="pesquisa" class="w-full p-2 border rounded-l" placeholder="Buscar por nome ou email" value="{{ request('pesquisa') }}">
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-r hover:bg-blue-700">
                    🔍 Buscar
                </button>
            </div>
        </form>

        @if(request('pesquisa'))
            <!-- Exibe o botão de recarregar todos os usuários apenas se houver pesquisa -->
            <div class="mb-4 text-center">
                <a href="{{ route('usuarios.index') }}" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700 transition">
                    🔄 Recarregar Todos os Usuários
                </a>
            </div>
        @endif

        <!-- Mensagem se nenhum usuário for encontrado -->
        @if(request('pesquisa') && $usuarios->isEmpty())
            <div class="alert bg-yellow-100 text-yellow-800 p-2 rounded text-center">
                Nenhum usuário encontrado para "{{ request('pesquisa') }}".
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg p-4">
            <ul class="space-y-4">
                @foreach ($usuarios as $usuario)
                    <li class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-900"><strong>Nome:</strong> {{ $usuario->name }}</p>
                        <p class="text-gray-900"><strong>Email:</strong> {{ $usuario->email }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Paginação -->
        <div class="mt-4 flex justify-center space-x-2">
            @if ($usuarios->hasPages())
                {{-- Botão Anterior --}}
                @if ($usuarios->onFirstPage())
                    <button class="px-4 py-2 text-gray-500 bg-gray-200 rounded cursor-not-allowed" disabled>Anterior</button>
                @else
                    <a href="{{ $usuarios->previousPageUrl() . '&pesquisa=' . urlencode(request('pesquisa')) }}" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700 transition">Anterior</a>
                @endif

                {{-- Botão Próxima --}}
                @if ($usuarios->hasMorePages())
                    <a href="{{ $usuarios->nextPageUrl() . '&pesquisa=' . urlencode(request('pesquisa')) }}" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700 transition">Próxima</a>
                @else
                    <button class="px-4 py-2 text-gray-500 bg-gray-200 rounded cursor-not-allowed" disabled>Próxima</button>
                @endif
            @endif
        </div>
    </div>
</body>
</html>
