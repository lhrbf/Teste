<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ config('cadastro', 'Laravel') }}</title>
</head>
<body>
    <div class="card text-center">
        <div class="card-header">
          CADASTRO
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('cadastro') }}">
                <div>
                    <label for="name" class="form-label">Nome completo</label>
                    <input type="text" class="form-control" id="name" placeholder="Digite seu nome completo" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Digite o Email" required>
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" placeholder="Digite o CPF" required>
                </div>
                <div>
                    <label for="estado">Selecione um estado</label>
                    <select id="estado" class="form-control" name="estado" required>
                        <option value="">Selecione um estado</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="cep">CEP</label>
                    <input type="text" id="cep" class="form-control" name="cep" placeholder="Digite o CEP" required>
                </div>
                <div class="mt-3">
                    <label for="rua">Rua</label>
                    <input type="text" id="rua" class="form-control" name="rua" placeholder="Digite o nome da rua" required>
                </div>
                <div class="form-group mt-3">
                    <label for="numero">Número</label>
                    <input type="text" id="numero" class="form-control" placeholder="Número da residência" required>
                </div>
                <div class="mt-3">
                    <label for="inputNumber" class="form-label">Número de telefone</label>
                    <input type="text" id="inputNumber" class="form-control" placeholder="Digite o número de telefone" required>
                </div>
                <div class="mt-3">
                    <label for="inputPassword" class="form-label">Senha</label>
                    <input type="password" id="inputPassword" class="form-control" aria-describedby="passwordHelpBlock" required>
                    <input type="password" id="inputPasswordConfirmation" name="passwordConfirmation" placeholder="Confirme a senha" required>
                </div>
                <div id="passwordHelpBlock" class="form-text">
                    Sua senha deve conter entre 8 e 20 caracteres, incluindo letras e números, e não pode conter espaços ou caracteres especiais.
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary mb-3">Cadastrar</button>
                </div>
            </form>
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