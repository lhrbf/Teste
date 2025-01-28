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
        <div class="card text-center my-5 border-primary-subtle">
            <div class="card-header bg-body-tertiary fw-medium border-primary-subtle">
              CADASTRO
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    <div class="row justify-content-center d-flex mb-3">
                        <label for="name" class="col-12 w-75 justify-content-start d-flex form-label">Nome completo</label>
                        <input type="text" class="border-primary-subtle col-12 w-75 form-control" id="name" placeholder="Digite seu nome completo" required>
                    </div>
                    <div class="row justify-content-center d-flex mb-3">
                        <label for="email" class="col-12 w-75 justify-content-start d-flex form-label">Email</label>
                        <input type="email" class="border-primary-subtle col-12 w-75 form-control" id="email" placeholder="Digite o Email" required>
                    </div>
                    <div class="row justify-content-center d-flex mb-3">
                        <label for="cpf" class="col-12 w-75 justify-content-start d-flex form-label">CPF</label>
                        <input type="text" class="border-primary-subtle col-12 w-75 form-control" id="cpf" placeholder="Digite o CPF" required>
                    </div>
                    <div class="row justify-content-center d-flex" >
                        <label for="estado" class="w-75 justify-content-start d-flex">Selecione um estado</label>
                        <select id="estado" class="border-primary-subtle col-12 w-75 form-control" name="estado" required>
                            <option value="">Selecione um estado</option>
                        </select>
                    </div>
                    <div class="row justify-content-center d-flex mt-3">
                        <label for="cep" class="w-75 justify-content-start d-flex">CEP</label>
                        <input type="text" id="cep" class="border-primary-subtle col-12 w-75 form-control" name="cep" placeholder="Digite o CEP" required>
                    </div>
                    <div class="row justify-content-center d-flex mt-3">
                        <label for="rua" class="w-75 justify-content-start d-flex">Rua</label>
                        <input type="text" id="rua" class="border-primary-subtle col-12 w-75 form-control" name="rua" placeholder="Digite o nome da rua" required>
                    </div>
                    <div class="row justify-content-center d-flex form-group mt-3">
                        <label for="numero" class="w-75 justify-content-start d-flex">Número</label>
                        <input type="number" id="numero" class="border-primary-subtle col-12 w-75 form-control" placeholder="Número da residência" required>
                    </div>
                    <div class="row justify-content-center d-flex mt-3">
                        <label for="inputNumber" class="col-12 w-75 justify-content-start d-flex form-label">Número de telefone</label>
                        <input type="tel" id="inputNumber" class="border-primary-subtle col-12 w-75 form-control" placeholder="Digite o número de telefone" required>
                    </div>
                    <div class="row justify-content-center d-flex mt-3">
                        <label for="inputPassword" class="col-12 w-75 justify-content-start d-flex form-label">Senha</label>
                        <input type="password" id="inputPassword" name="password" class="border-primary-subtle col-12 w-75 form-control" placeholder="Digite uma Senha" aria-describedby="passwordHelpBlock" required>
                    </div>
                    <div class="row justify-content-center d-flex mt-3"> 
                        <label for="inputPassword" class="col-12 w-75 justify-content-start d-flex form-label">Confirme a Senha</label>
                        <input type="password" id="inputPasswordConfirmation" class="border-primary-subtle col-12 w-75 form-control" name="passwordConfirmation" placeholder="Confirme a senha" required>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-auto px-4 my-2 fs-5">Cadastrar</button>
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