<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ config('login', 'Laravel') }}</title>
</head>
    <body>
        <div class="container">
            <div class="card border-dark mt-5">
                <div class="card-header border-dark bg-dark text-white fw-medium">
                    LOGIN
                </div>
                <div class="card-body bg-body-tertiary">
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="row justify-content-center d-flex">
                            <div class="col-12 col-md-10 col-lg-7 mb-3">
                                <label for="email" id="labelEmail" class="form-label mb-1">Email</label>
                                <input type="email" name="email" class="form-control border-dark" id="email" placeholder="Digite o Email" autocomplete="email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
        
                            <div class="col-12 col-md-10 col-lg-7 mb-3">
                                <label for="password" id="labelPassword" class="form-label mb-1">Senha</label>
                                <input type="password" name="password" id="password" class="form-control border-dark" autocomplete="current-password" required>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
        
                            <div class="col-12 col-md-5 col-lg-6 mb-3 text-center">
                                <button type="submit" class="btn btn-primary w-75 px-4 mt-2 fs-5">Entrar</button>
                            </div>
                        </div>
        
                    </form>
                    <div class="row justify-content-center d-flex mt-3">
                        <div class="col-12 justify-content-center d-flex text-center">
                            <a href="{{ route('cadastro')}}" class="btn btn-outline-primary">Não tem login? Clique aqui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
        <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
        <script>
            document.getElementById('loginForm').addEventListener('submit', function (e) {
                e.preventDefault();
                console.log('Formulário enviado');

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        axios.post('/login', {
            email: email,
            password: password
        })
        .then(function (response) {
            if (response.status === 200) {
                window.location.href = '/grafico';
            }
        })
        .catch(function (error) {
        console.log('Erro na requisição', error);
    });
    });
        </script>
    
    </body>
</html>