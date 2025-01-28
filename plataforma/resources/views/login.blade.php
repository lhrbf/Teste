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
            <div class="card text-center border-primary-subtle mt-5">
                <div class="card-header border-primary-subtle bg-body-tertiary fw-medium">
                    LOGIN
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="row justify-content-center d-flex mb-3">
                            <label for="email" class="col-12 form-label justify-content-start d-flex w-75">Email</label>
                            <input type="email" name="email" class="border-primary-subtle col-12 w-75 form-control" id="email" placeholder="Digite o Email" autocomplete="email" required>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="row justify-content-center d-flex my-3">
                            <label for="inputPassword" class="col-12 form-label justify-content-start d-flex w-75">Password</label>
                            <input type="password" name="password" id="inputPassword" class="border-primary-subtle col-12 w-75 form-control" autocomplete="current-password" required>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-auto px-4 my-2 fs-5">Entrar</button>
                        </div>
                    </form>
            
                    <div class="card-footer border-primary-subtle bg-white">
                        <a href="{{ route('cadastro')}}" class="mt-1 mb-0 btn btn-outline-primary">Não tem login? Clique aqui</a>
                    </div>
                </div>
            </div>
        </div>    
                
        <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    </body>
</html>