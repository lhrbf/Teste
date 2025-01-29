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
        <canvas id="myChart" style="width: 100%; height: 250px;"></canvas>
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

    // filtro de período para o gráfico
    document.getElementById('periodo').addEventListener('change', () => {
        const periodo = document.getElementById('periodo').value;
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');

        let startDate = '';
        let endDate = '';

        switch (periodo) {
            case '1':
                startDate = new Date().toISOString().split('T')[0];
                endDate = startDate;
                break;
            case '2':
                const yesterday = new Date();
                yesterday.setDate(yesterday.getDate() - 1);
                startDate = yesterday.toISOString().split('T')[0];
                endDate = startDate;
                break;
            case '3':
                const sevenDaysAgo = new Date();
                sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);
                startDate = sevenDaysAgo.toISOString().split('T')[0];
                endDate = new Date().toISOString().split('T')[0];
                break;
            case '4':
                const oneMonthAgo = new Date();
                oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);
                startDate = oneMonthAgo.toISOString().split('T')[0];
                endDate = new Date().toISOString().split('T')[0];
                break;
            case '5':
                const threeMonthsAgo = new Date();
                threeMonthsAgo.setMonth(threeMonthsAgo.getMonth() - 3);
                startDate = threeMonthsAgo.toISOString().split('T')[0];
                endDate = new Date().toISOString().split('T')[0];
                break;
            default:
                return;
        }

        startDateInput.value = startDate;
        endDateInput.value = endDate;
    });

    // gráfico inicial
    let graficoInicial;

    const labels = ['Dados filtrados por período']

    axios.get('/api/grafico/inicial')
        .then(response => {
            const data = response.data.data;

            const inicioDepositos = [data.totalDepositos];
            const inicioVisitas = [data.totalVisitas];
            const inicioFtds = [data.totalFtds];
            const inicioLogins = [data.totalLogins];
            const inicioCadastros = [data.totalCadastros];

        graficoInicial = new Chart(document.getElementById('myChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Depósitos',
                        data: inicioDepositos,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                    },
                    {
                        label: 'Visitas',
                        data: inicioVisitas,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 2,
                    },
                    {
                        label: 'FTDs',
                        data: inicioFtds,
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderWidth: 2,
                    },
                    {
                        label: 'Logins',
                        data: inicioLogins,
                        borderColor: 'rgba(255, 159, 64, 1)',
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderWidth: 2,
                    },
                    {
                        label: 'Cadastros',
                        data: inicioCadastros,
                        borderColor: 'rgba(black, 1)',
                        backgroundColor: 'rgba(190, 190, 190, 0.2)',
                        borderWidth: 2,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Gráfico de Atividades',
                    }
                },
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Quantidade',
                        },
                        beginAtZero: true,
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Erro ao carregar os dados do gráfico:', error);
    });

    document.getElementById('buttonFiltrar').addEventListener('click', () => {
        const periodo = document.getElementById('periodo').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        console.log('Período:', periodo);
        console.log('Data inicial:', startDate);
        console.log('Data final:', endDate);

        if (!periodo && (!startDate || !endDate)) {
            alert('Por favor, selecione um período ou insira um intervalo de datas.');
            return;
        }

        const apiGrafico = '{{  url('/api/grafico/filtro')  }}';

        axios.post(apiGrafico, {periodo, startDate, endDate})
            .then(response => {
            console.log('Dados do servidor:', response.data);

            atualizarGrafico(response.data);

            })
            .catch(error => console.error('Erro ao buscar dados: ', error));
        });

// grafico filtrado
    let grafico;

    function atualizarGrafico(data) {
        const ctx = document.getElementById('myChart').getContext('2d');

        const numsDepositos = [data.depositos];
        const numsVisitas = [data.visitas];
        const numsFtds = [data.ftds];
        const numsLogins = [data.logins];
        const numsCadastros = [data.cadastros];

        if (graficoInicial) {
            graficoInicial.destroy();
        }

        else if(grafico){
            grafico.destroy();
        }

    grafico = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Depósitos',
                    data: numsDepositos,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                },
                {
                    label: 'Visitas',
                    data: numsVisitas,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2,
                },
                {
                    label: 'FTDs',
                    data: numsFtds,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderWidth: 2,
                },
                {
                    label: 'Logins',
                    data: numsLogins,
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderWidth: 2,
                },
                {
                    label: 'Cadastros',
                    data: numsCadastros,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Gráfico de Atividades'
                }
            },
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Quantidade'
                    },
                    beginAtZero: true
                }
            }
        }
    });
}

    // cards
    const apiLogins = '{{  url('/api/logins')  }}';
    const apiVisitas = '{{  url('/api/visitas')  }}';
    const apiCadastros = '{{  url('/api/cadastros')  }}';
    const apiFtds = '{{  url('/api/ftds')  }}';
    const apiDepositos = '{{  url('/api/depositos')  }}';
    const apiValorDepositos = '{{  url('/api/valor-total-depositos')  }}';
    const apiValorFtds = '{{  url('/api/valor-total-ftds')  }}';

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
            console.log(response); // retorno dos valores da API(GET) em JSON
            
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

            document.getElementById('logins').innerHTML = totalLogins;
            document.getElementById('visitas').innerHTML = totalVisitas;
            document.getElementById('cadastros').innerHTML = totalCadastros;
            document.getElementById('ftds').innerHTML = totalFtds;
            document.getElementById('ftdsValor').innerHTML = valorFormatadoFtds;
            document.getElementById('depositos').innerHTML = totalDepositos;
            document.getElementById('depositosValor').innerHTML = valorFormatadoDepositos;
        })
            .catch(error => {  
                console.error('Erro ao obter os dados:', error);
            });
    </script>
</body>
</html>