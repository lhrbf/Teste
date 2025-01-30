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
        <div class="container">
                    <form id="form">
                        @csrf
                        <div class="row justify-content-center d-flex">
                            <div class="col-12 col-md-10 col-lg-7 mb-3">
                                <label for="email" id="labelEmail" class="form-label mb-1">Email</label>
                                <input type="email" name="email" class="form-control border-dark" id="email" placeholder="Digite o Email" autocomplete="email" required>
                            </div>
        
                            <div class="col-12 col-md-10 col-lg-7 mb-3">
                                <label for="password" id="labelPassword" class="form-label mb-1">Senha</label>
                                <input type="password" name="password" id="password" class="form-control border-dark" autocomplete="current-password" required>
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
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
            
        form.addEventListener("submit", (event) => {
                event.preventDefault();

                if(email.value === "" || !isEmailValid(email)){
                    error(passor)
                    return;
                }

                if(password.value === "" || ){
                    alert("Insira email válido!");
                    return;
                }

                const data = {
                    email,
                    password
                }

                axios.post('/api/login', data)
                .then(response => 
                {
                    console.log(response.data);
                })
                .catch(error => {
                console.error('Erro:', error);
                });

                form.submit();

                function isEmailValid(email){
                    const emailRegex = new RegExp(
                        /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,}$/
                    );

                    if(emailRegex.teste(email)){
                        return true;
                    }
                    return false;
                }
            })

        </script>
    
    </body>
</html>