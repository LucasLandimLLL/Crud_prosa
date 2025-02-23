<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-0">Editar Cliente</h2>
            </div>

            <div class="card-body">
                <form id="formCliente" action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Nome -->
                        <div class="col-md-6">
                            <label class="form-label">Nome Completo</label>
                            <input type="text" 
                                   name="nome" 
                                   class="form-control @error('nome') is-invalid @enderror" 
                                   value="{{ old('nome', $cliente->nome) }}"
                                   required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- E-mail -->
                        <div class="col-md-6">
                            <label class="form-label">E-mail</label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $cliente->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Telefone -->
                        <div class="col-md-4">
                            <label class="form-label">Telefone</label>
                            <input type="text" 
                                   name="telefone" 
                                   class="form-control @error('telefone') is-invalid @enderror"
                                   value="{{ old('telefone', $cliente->telefone) }}"
                                   id="telefone"
                                   required>
                            @error('telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- CEP -->
                        <div class="col-md-4">
                            <label class="form-label">CEP</label>
                            <div class="input-group">
                                <input type="text" 
                                       name="cep" 
                                       id="cep"
                                       class="form-control @error('cep') is-invalid @enderror"
                                       value="{{ old('cep', $cliente->cep) }}"
                                       required>
                                <button type="button" class="btn btn-outline-secondary" id="btnVerificarCep">Verificar</button>
                            </div>
                            @error('cep')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Endereço Completo -->
                        <div class="col-md-4">
                            <label class="form-label">Endereço Completo</label>
                            <input type="text" 
                                   name="endereco" 
                                   id="endereco"
                                   class="form-control @error('endereco') is-invalid @enderror"
                                   value="{{ old('endereco', $cliente->endereco) }}"
                                   required>
                            @error('endereco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Número -->
                        <div class="col-md-4">
                            <label class="form-label">Número</label>
                            <input type="text" 
                                   name="numero" 
                                   class="form-control @error('numero') is-invalid @enderror"
                                   value="{{ old('numero', $cliente->numero) }}"
                                   id="numero"
                                   required>
                            @error('numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botões -->
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Atualizar Cliente
                            </button>
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS e Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para integração com o ViaCEP -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnVerificarCep = document.getElementById('btnVerificarCep');
            const inputCep = document.getElementById('cep');
            const inputEndereco = document.getElementById('endereco');

            // Função para limpar o campo de endereço
            function limparCampos() {
                inputEndereco.value = '';
            }

            // Função para preencher o campo de endereço completo
            function preencherEndereco(dados) {
                inputEndereco.value = dados.logradouro || '';
            }

            // Função para verificar o CEP
            function verificarCep() {
                const cep = inputCep.value.replace(/\D/g, ''); // Remove qualquer caractere não numérico

                if (cep.length !== 8) {
                    alert('CEP inválido. Certifique-se de que o CEP tenha 8 dígitos.');
                    return;
                }

                limparCampos(); // Limpa o campo antes de tentar preencher com novos dados

                const url = `https://viacep.com.br/ws/${cep}/json/`;

                fetch(url)
                    .then(response => response.json())
                    .then(dados => {
                        if (dados.erro) {
                            alert('CEP não encontrado.');
                        } else {
                            preencherEndereco(dados);
                        }
                    })
                    .catch(() => {
                        alert('Erro ao buscar o CEP. Tente novamente.');
                    });
            }

            // Adiciona o evento de click no botão para verificar o CEP
            if (btnVerificarCep) {
                btnVerificarCep.addEventListener('click', verificarCep);
            }

            // Máscaras de entrada interativas
            Inputmask({"mask": "(99) 99999-9999"}).mask(document.getElementById("telefone"));
            Inputmask({"mask": "99999-999"}).mask(document.getElementById("cep"));

            // Validação adicional para garantir que os campos de telefone e CEP estão completos antes de enviar
            const formCliente = document.getElementById('formCliente');
            formCliente.addEventListener('submit', function(event) {
                const telefone = document.getElementById('telefone').value;
                const cep = document.getElementById('cep').value;

                // Validação do telefone: Se o telefone não tiver 14 caracteres (formato (99) 99999-9999)
                if (telefone.replace(/\D/g, '').length < 11) {
                    alert('Por favor, insira um número de telefone completo.');
                    event.preventDefault(); // Impede o envio do formulário
                    return;
                }

                // Validação do CEP: Se o CEP não tiver 8 dígitos
                if (cep.replace(/\D/g, '').length !== 8) {
                    alert('Por favor, insira um CEP válido.');
                    event.preventDefault(); // Impede o envio do formulário
                    return;
                }
            });
        });
    </script>
</body>
</html>
