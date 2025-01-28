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
    
    <div class="container">
        <div class="card justify-content-center d-flex my-5 border-black">
            <div class="card-header bg-dark text-white fw-medium border-black">
              CADASTRO
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    <div class="row justify-content-center d-flex">
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="name" class="form-label mb-1">Nome completo</label>
                            <input type="text" class="form-control border-dark" id="name" placeholder="Digite seu nome completo" required>
                        </div>
                            <div class="col-12 col-lg-5 col-md-4 mb-3">
                                <label for="email" class="form-label mb-1">Email</label>
                                <input type="email" class="form-control border-dark" id="email" placeholder="Digite o Email" required>
                            </div>
                    </div>
                    <div class="row justify-content-center d-flex">
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="cpf" class="form-label mb-1">CPF</label>
                            <input type="text" class="form-control border-dark" id="cpf" placeholder="Digite o CPF" required>
                        </div>
                            <div class="col-12 col-lg-5 col-md-4 mb-3">
                                <label for="estado" class="form-label mb-1">Selecione um estado</label>
                                <select id="estado" class="form-control border-dark" name="estado" required>
                                    <option value="">Selecione um estado</option>
                                </select>
                            </div>
                    </div>
                    <div class="row justify-content-center d-flex">
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="cep" class="form-label mb-1">CEP</label>
                            <input type="text" id="cep" class="form-control border-dark" name="cep" placeholder="Digite o CEP" required>
                        </div>
                            <div class="col-12 col-lg-5 col-md-4 mb-3">
                                <label for="rua" class="form-label mb-1">Rua</label>
                                <input type="text" id="rua" class="form-control border-dark" name="rua" placeholder="Digite o nome da rua" required>
                            </div>
                    </div>
                    <div class="row justify-content-center d-flex">
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="numero" class="form-label mb-1">Número</label>
                            <input type="number" id="numero" class="form-control border-dark" placeholder="Número da residência" required>
                        </div>
                            <div class="col-12 col-lg-5 col-md-4 mb-3">
                                <label for="inputNumber" class="form-label mb-1">Número de telefone</label>
                                <input type="tel" id="inputNumber" class="form-control border-dark" placeholder="Digite o número de telefone" required>
                            </div>
                    </div>
                    <div class="row justify-content-center d-flex">
                        <div class="col-12 col-lg-5 col-md-4 mb-3">
                            <label for="inputPassword" class="form-label mb-1">Senha</label>
                            <input type="password" id="inputPassword" name="password" class="form-control border-dark" placeholder="Digite uma senha" required>
                        </div>
                            <div class="col-12 col-lg-5 col-md-4 mb-3">
                                <label for="inputPasswordConfirmation" class="form-label mb-1">Confirme a senha</label>
                                <input type="password" id="inputPasswordConfirmation" name="passwordConfirmation" class="form-control border-dark" placeholder="Confirme a senha" required>
                            </div>
                    </div>
                    <div class="mt-3 mb-2 justify-content-center d-flex">
                        <button type="submit" class="btn btn-primary w-auto px-4 fs-5">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        let cpfMask = new Inputmask("999.999.999-99");
        cpfMask.mask(document.getElementById("cpf"));

        const cepInput = document.getElementById('cep');
        const im = new Inputmask('99999-999');
        im.mask(cepInput);

        axios.get('https://brasilapi.com.br/api/v1/states')
        .then(response => {
            const selectEstado = document.getElementById('estado');
            const estados = response.data

            estados.forEach(estado => {
                const option = document.createElement('option');
                option.value = estado.sigla;
                option.textContent = estado.nome;
                selectEstado.appendChild(option);
            });
        })
        .catch(error => console.log('Erro ao carregar estados: ', error));

        document.getElementById('cep').addEventListener('blur', () => {
            const cep = cepInput.value.replace('-', '').replace('.', '');
            if (cep.length === 8) {
                axios.get(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => {
                    const data = response.data;
                    if (!data.erro) {
                        document.getElementById('rua').value = data.logradouro;
                        document.getElementById('estado').value = data.uf;
                    } else {
                        alert('CEP não encontrado!');
                    }
                })
                .catch(() => alert('Erro ao buscar o CEP!'));
            }
        });

        const form = document.querySelector('form');
            form.addEventListener('submit', (event) => {
                const password = document.getElementById('inputPassword').value;
                const confirmPassword = document.getElementById('inputPasswordConfirmation').value;

            if (password !== confirmPassword) {
                event.preventDefault();
                alert('As senhas não coincidem!');
            }
        });
    </script>
</body>
</html>