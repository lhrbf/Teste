<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ config('index', 'Laravel') }}</title>
</head>
<body>
    <div class="card text-center">
        <div class="card-header">
            LOGIN
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('/') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" placeholder="Digite o CPF" required>
                </div>
                
                <div>
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" required>
                </div>
                
                <div id="passwordHelpBlock" class="form-text">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                </div>
                
                <div>
                    <button type="submit" class="btn btn-primary mb-3">Entrar</button>
                </div>
            </form>
    
            <div class="card-footer text-body-secondary">
                <a href="#" class="btn btn-primary">Não tem login? Clique aqui</a>
            </div>
        </div>
    </div>
    
            
      <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

      <script>
        let cpfMask = new Inputmask("999.999.999-99");
            cpfMask.mask(document.getElementById("cpf"));
      </script>
</body>
</html>