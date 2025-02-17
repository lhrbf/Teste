<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ config('cadastro', 'Laravel') }}</title>
</head>
<body>
    <div>
        <a href="javascript:history.back()"><i id="voltarBtn" class="bi bi-arrow-return-left text-primary fs-1 py-0 px-2 mt-2 ms-2 btn btn-outline-primary"></i></a>
    </div>

        <div class="container mt-4 mb-3">
            <form id="form" class="bg-body-tertiary border rounded p-3">
                @csrf
                <div class="form-group row justify-content-center d-flex">
                    <div class="col-12 col-lg-5 col-md-4 mb-3">
                        <label for="inputName" class="form-label mb-1">Nome completo</label>
                        <input type="text" class="form-control border-dark" id="inputName" name="inputName" placeholder="Digite seu nome completo" required>
                    </div>
                    <div class="col-12 col-lg-5 col-md-4 mb-3">
                        <label for="inputEmail" class="form-label mb-1">Email</label>
                        <input type="email" class="form-control border-dark" id="inputEmail" name="inputEmail" placeholder="Digite o Email" required>
                    </div>
                </div>

                    <div class="form-group row justify-content-center d-flex">
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="inputCpf" class="form-label mb-1">CPF</label>
                            <input type="text" class="form-control border-dark" id="inputCpf" name="inputCpf" placeholder="Digite o CPF" required>
                        </div>
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="inputEstado" class="form-label mb-1">Estado</label>
                            <select id="inputEstado" class="form-control border-dark" name="inputEstado" required>
                                <option value="">Selecione um estado</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center d-flex">
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="inputCep" class="form-label mb-1">CEP</label>
                            <input type="number" id="inputCep" class="form-control border-dark" name="inputCep" placeholder="Digite o CEP" required>
                        </div>
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="inputRua" class="form-label mb-1">Rua</label>
                            <input type="text" id="inputRua" class="form-control border-dark" name="inputRua" placeholder="Digite o nome da rua" required>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center d-flex">
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="numero_casa" class="form-label mb-1">Número</label>
                            <input type="number" id="numero_casa" class="form-control border-dark" name="numero_casa" placeholder="Número da residência" required>
                        </div>
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="inputNumero" class="form-label mb-1">Número de telefone</label>
                            <input type="tel" id="inputNumero" name="inputNumero" class="form-control border-dark" placeholder="Digite o número de telefone" required>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center d-flex">
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="inputPassword" class="form-label mb-1">Senha</label>
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control border-dark" placeholder="Digite uma senha" required>
                        </div>
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="inputPasswordConfirmation" class="form-label mb-1">Confirme a senha</label>
                            <input type="password" id="inputPasswordConfirmation" name="inputPasswordConfirmation" class="form-control border-dark" placeholder="Confirme a senha" required>
                        </div>
                    </div>

                    <div class="mt-3 mb-2 justify-content-center d-flex">
                        <button type="submit" class="btn btn-primary w-auto px-4 fs-5">Cadastrar</button>
                    </div>
                </form>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', () => {
            axios.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
            .then(response => {
                const estados = response.data;
                const selectEstado = document.getElementById('inputEstado');
                estados.forEach(estado => {
                    const option = document.createElement('option');
                    option.value = estado.sigla;
                    option.textContent = estado.nome;
                    selectEstado.appendChild(option);
                });
            })
            .catch(error => {
                console.log('Erro ao carregar estados: ', error);
            });
        });

        document.getElementById('inputCep').addEventListener('blur', () => {
            const cepInput = document.getElementById('inputCep').value.replace('-', '').replace('.', '');
            if (cepInput.length === 8) {
                axios.get(`https://viacep.com.br/ws/${cepInput}/json/`)
                    .then(response => {
                        const cepData = response.data;
                        if (!cepData.erro) {
                            document.getElementById('inputRua').value = cepData.logradouro;
                            document.getElementById('inputEstado').value = cepData.uf;
                        } else {
                            alert('CEP não encontrado!');
                        }
                    })
                    .catch(() => alert('Erro ao buscar o CEP!'));
                }
            });

    document.querySelector('form').addEventListener('submit', (event) => {
        event.preventDefault();

        const fullName = document.getElementById('inputName').value;
        const email = document.getElementById('inputEmail').value;
        const password = document.getElementById('inputPassword').value;
        const confirmPassword = document.getElementById('inputPasswordConfirmation').value;
        const numeroCasa = document.getElementById('numero_casa').value;
        const numeroTel = document.getElementById('inputNumero').value;
        const cep = document.getElementById('inputCep').value;
        const selectEstado = document.getElementById('inputEstado').value;

        if (!email || !isEmailValid(email)) {
            alert('Insira um e-mail válido!');
            return;
        }

        if (password !== confirmPassword) {
            alert('As senhas não coincidem!');
            return;
        }

        const data = {
            fullName,
            email,
            password,
            confirmPassword,
            selectEstado,
            numeroCasa,
            numeroTel,
            cep,
        };

        axios.post('/register', data)
            .then(response => {
                console.log(response.data);
                window.location.href = '/login'; 
            })
            .catch(error => {
                console.error('Erro: ', error);
            });
        });

        function isEmailValid(email) {
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,}$/;
            return emailRegex.test(email);
        }

    </script>
</body>
</html>