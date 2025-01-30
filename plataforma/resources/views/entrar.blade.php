<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ config('entrar', 'Laravel') }}</title>
</head>
    <body>
        <div class="container mt-5 mb-3">
            <form id="form" class="bg-body-tertiary border rounded pt-2 pb-3 px-3">
                <div class="form-group pt-4 row justify-content-center d-flex">
                    <div class="col-12 col-md-10 col-lg-7 mb-3">
                        <label for="email" id="labelEmail" class="form-label mb-1">Email</label>
                        <input type="email" name="email" class="form-control border-dark" id="email" placeholder="Digite o Email" autocomplete="email" required>
                    </div>

                    <div class="col-12 col-md-10 col-lg-7 mb-3">
                        <label for="password" id="labelPassword" class="form-label mb-1">Senha</label>
                        <input type="password" name="password" id="password" class="form-control border-dark" placeholder="Digite a senha" autocomplete="current-password" required>
                    </div>
            
                    <div class="col-12 col-md-5 col-lg-6 mb-3 text-center">
                        <button type="submit" class="btn btn-primary w-75 px-4 mt-3 fs-5">Entrar</button>
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex mt-3">
                    <div class="col-12 justify-content-center d-flex text-center">
                        <a href="{{ route('cadastro')}}" class="btn btn-outline-primary">Não tem login? Clique aqui</a>
                    </div>
                </div>
            </form>
        </div>            

        <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
        <script>  
            const form = document.getElementById('form');
            
            form.addEventListener("submit", (event) => {
                event.preventDefault();

                const email = document.getElementById("email").value;
                const password = document.getElementById("password").value;

                if(email === "" || !isEmailValid(email)){
                    alert("Insira um email válido!")
                    return;
                }

                if(password === ""){
                    alert("Insira uma senha válida!");
                    return;
                }

                const data = { email, password };

                axios.post('/login', data,)
                .then(response => {
                    if (response.data.success) {
                        window.location.href = '/grafico';
                    } else {
                        alert('Erro no login. Tente novamente!');
                    }
                })
                .catch(error => {
                    if (error.response) {
                        console.error('Erro:', error.response.data);
                        alert('Credenciais inválidas. Tente novamente!');
                    } else if (error.request) {
                        console.error('Erro na requisição:', error.request);
                        alert('Erro ao fazer a requisição. Tente novamente mais tarde!');
                    } else {
                        console.error('Erro desconhecido:', error.message);
                        alert('Erro desconhecido. Tente novamente!');
                    }
                });
            });

            function isEmailValid(email){
                const emailRegex = new RegExp(
                    /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,}$/
                );

                if(emailRegex.test(email)){
                    return true;
                }
                return false;
            }
        </script>
    
    </body>
</html>