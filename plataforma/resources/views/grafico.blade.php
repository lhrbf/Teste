<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ config('grafico', 'Laravel') }}</title>
</head>
<body>
    <header class="justify-content-center d-flex">
        <div class="container justify-content-center d-flex my-1 py-4 row gap-1">
            <div class="col-12 col-sm-12 col-md-10 col-lg-3">
                <select class="form-select" aria-label="periodo" id="periodo" name="periodo">
                    <option value="" selected disabled>Selecione um Período</option>
                    <option id="today" value="1">Hoje</option>
                    <option id="yesterday" value="2">Ontem</option>
                    <option id="sevenDaysAgo" value="3">Sete dias atrás</option>
                    <option id="oneMonth" value="4">Um mês</option>
                    <option id="threeMonths" value="5">Três meses</option>
                </select>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-3">
                <input type="date" class="form-control" id="startDate" disabled>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-3">
                <input type="date" class="form-control" id="endDate" disabled>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-2 justify-content-center d-flex">
                <button id="buttonFiltrar" type="button" class="btn btn-primary w-75">Filtrar</button>
            </div>
        </div>
    </header>
    
    <main class="container justify-content-center d-flex my-4 mb-4 px-2" style="width: 100%; height: 100%; max-width: 800px;">
        <canvas id="myChart" style="width: 100%;"></canvas>
    </main>

    <footer class="justify-content-center d-flex my-5">
        <div class="container justify-content-center d-flex row gap-3">
            <div class="justify-content-center d-flex col-12 col-sm-10 col-md-5 col-lg-3">
                <div class="card bg-danger" style="width: 15rem;">
                    <div class="card-header text-white">
                        Visitas
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center fw-bold" id="visitas"></li>
                    </ul>
                </div>
            </div>
            <div class="justify-content-center d-flex col-12 col-sm-10 col-md-5 col-lg-3">
                <div class="card bg-warning" style="width: 15rem;">
                    <div class="card-header text-white">
                        Login
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center fw-bold" id="logins"></li>
                    </ul>
                </div>
            </div>
            <div class="justify-content-center d-flex col-12 col-sm-10 col-md-5 col-lg-3">
                <div class="card" style="width: 15rem; background-color:rgb(21, 48, 48);">
                    <div class="card-header text-white">
                        Cadastro
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center fw-bold" id="cadastros"></li>
                    </ul>
                </div>
            </div>
            <div class="justify-content-center d-flex col-12 col-sm-10 col-md-5 col-lg-3">
                <div class="justify-content-center d-flex card bg-info-subtle" style="width: 15rem;">
                    <div class="card-header text-white bg-info">
                        FTD
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center fw-bold" id="ftds"></li>
                        <li class="list-group-item text-center fw-bold" id="ftdsValor"></li>
                    </ul>
                </div>
            </div>
            <div class="justify-content-center d-flex col-12 col-sm-10 col-md-5 col-lg-3">
                <div class="card bg-success" style="width: 15rem;">
                    <div class="card-header text-white">
                        Depósito
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center fw-bold" id="depositos"></li>
                        <li class="list-group-item text-center fw-bold" id="depositosValor"></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
// APIS GET dos dados totais
    const apiLogins = '/api/logins';
    const apiVisitas = '/api/visitas';
    const apiCadastros = '/api/cadastros';
    const apiFtds = '/api/ftds';
    const apiDepositos = '/api/depositos';
    const apiValorDepositos = '/api/valor-total-depositos';
    const apiValorFtds = '/api/valor-total-ftds';

    Promise.all([
        axios.get(apiLogins),
        axios.get(apiVisitas),
        axios.get(apiCadastros),
        axios.get(apiFtds),
        axios.get(apiDepositos),
        axios.get(apiValorDepositos),
        axios.get(apiValorFtds)
    ])
        .then(response => {
            const totalLogins = response[0].data.totalLogins;
            const totalVisitas = response[1].data.totalVisitas;
            const totalCadastros = response[2].data.totalCadastros;
            const totalFtds = response[3].data.totalFtds;
            const totalDepositos = response[4].data.totalDepositos;
            const valorTotalDepositos = response[5].data.valorTotalDepositos;
            const valorTotalFtds = response[6].data.valorTotalFtds;
            
            const valorFormatadoDepositos = new Intl.NumberFormat('pt-BR', { 
                style: 'currency', 
                currency: 'BRL' 
            }).format(valorTotalDepositos);

            const valorFormatadoFtds = new Intl.NumberFormat('pt-BR', { 
                style: 'currency', 
                currency: 'BRL' 
            }).format(valorTotalFtds);

            // Cards
            document.getElementById('logins').innerHTML = totalLogins;
            document.getElementById('visitas').innerHTML = totalVisitas;
            document.getElementById('cadastros').innerHTML = totalCadastros;
            document.getElementById('ftds').innerHTML = totalFtds;
            document.getElementById('ftdsValor').innerHTML = valorFormatadoFtds;
            document.getElementById('depositos').innerHTML = totalDepositos;
            document.getElementById('depositosValor').innerHTML = valorFormatadoDepositos;

            // Criar gráfico
            new Chart(document.getElementById('myChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Dados filtrados'],
                    datasets: [
                        {
                            label: 'Depósitos',
                            data: [totalDepositos],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                        },
                        {
                            label: 'Visitas',
                            data: [totalVisitas],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                        },
                        {
                            label: 'FTDs',
                            data: [totalFtds],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 2,
                        },
                        {
                            label: 'Logins',
                            data: [totalLogins],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                        },
                        {
                            label: 'Cadastros',
                            data: [totalCadastros],
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 2,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {  
            console.error('Erro ao obter os dados:', error);
        });

// Filtro por período
    document.getElementById('buttonFiltrar').addEventListener('click', () => {
    
        const periodo = document.getElementById('periodo').value;

        let startDate = '';
        let endDate = '';

        switch (periodo) {
            case '1': // Hoje
                startDate = new Date().toISOString().split('T')[0];
                endDate = startDate;
                break;
            case '2': // Ontem
                const yesterday = new Date();
                yesterday.setDate(yesterday.getDate() - 1);
                startDate = yesterday.toISOString().split('T')[0];
                endDate = startDate;
                break;
            case '3': // Sete dias atrás
                const sevenDaysAgo = new Date();
                sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);
                startDate = sevenDaysAgo.toISOString().split('T')[0];
                endDate = new Date().toISOString().split('T')[0];
                break;
            case '4': // Um mês
                const oneMonthAgo = new Date();
                oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);
                startDate = oneMonthAgo.toISOString().split('T')[0];
                endDate = new Date().toISOString().split('T')[0];
                break;
            case '5': // Três meses
                const threeMonthsAgo = new Date();
                threeMonthsAgo.setMonth(threeMonthsAgo.getMonth() - 3);
                startDate = threeMonthsAgo.toISOString().split('T')[0];
                endDate = new Date().toISOString().split('T')[0];
                break;
            default:
                alert("Selecione um período válido.");
                return;
        }

        document.getElementById('startDate').value = startDate;
        document.getElementById('endDate').value = endDate;

        // Fazer a requisição para o filtro
        const urlFiltro = '/api/grafico/filtro'
        axios.post(urlFiltro, {
            periodo: periodo,
            startDate: startDate,
            endDate: endDate
        })
        .then(response => {
            console.log('Dados filtrados:', response.data);
        })
        .catch(error => {
            console.error('Erro ao filtrar os dados:', error);
        });
    });
    </script>
</body>
</html>