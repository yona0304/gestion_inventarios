@extends('layouts.layout')

@section('title', 'Inicio')

@section('content')

    <script src="https://code.highcharts.com/highcharts.js"></script>
    @if (Auth::check() && Auth::user()->rol === 'Super_Admin')
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
    @endif
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <div class="p-4 sm:ml-64">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Bienvenido al aplicativo</h2>
        <figure class="highcharts-figure grid grid-cols-1 md:grid-cols-2 gap-4">
            <div id="container" class="h-96"></div>
            <div id="container3" class="h-96"></div>
            {{-- <div id="container2" class="h-96"></div> --}}
        </figure>
    </div>


    <div class="p-4 sm:ml-64">
        <figure class="highcharts-figure grid grid-cols-1 md:grid-cols-2 gap-4">

            <div id="container4" class="h-96"></div>
        </figure>
    </div>

    <script>
        var ciudades = @json($ciudades);
        var series = @json($series);
        var data = @json($data);
        var dato2 = @json($dato2);

        console.log(ciudades)

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Inventario por regiones',
                align: 'left'
            },
            xAxis: {
                categories: ciudades
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Inventario por ciudad'
                },
                stackLabels: {
                    enabled: true
                }
            },
            legend: {
                align: 'left',
                x: 40,
                verticalAlign: 'top',
                y: 25,
                floating: true,
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: series,
            credits: {
                enabled: false // Desactiva los créditos de Highcharts
            }
        });
    </script>
    <script>
        Highcharts.chart('container3', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Estado de asignacion'
            },
            tooltip: {
                valueSuffix: '%'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: [{
                        enabled: true,
                        distance: 20
                    }, {
                        enabled: true,
                        distance: -40,
                        format: '{point.percentage:.1f}%',
                        style: {
                            fontSize: '1.2em',
                            textOutline: 'none',
                            opacity: 0.7
                        },
                        filter: {
                            operator: '>',
                            property: 'percentage',
                            value: 10
                        }
                    }]
                }
            },
            series: [{
                name: 'Percentage',
                colorByPoint: true,
                data: data

            }],
            credits: {
                enabled: false // Desactiva los créditos de Highcharts
            }
        });
    </script>
    <script>
        Highcharts.chart('container4', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Mantenimiento'
            },
            tooltip: {
                valueSuffix: '%'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: [{
                        enabled: true,
                        distance: 20
                    }, {
                        enabled: true,
                        distance: -40,
                        format: '{point.percentage:.1f}%',
                        style: {
                            fontSize: '1.2em',
                            textOutline: 'none',
                            opacity: 0.7
                        },
                        filter: {
                            operator: '>',
                            property: 'percentage',
                            value: 10
                        }
                    }]
                }
            },
            series: [{
                name: 'Percentage',
                colorByPoint: true,
                data: dato2
                /*  [
                                    {
                                        name: 'Correctivo',
                                        y: 55
                                    },
                                    {
                                        name: 'Preventivo',
                                        sliced: true,
                                        selected: true,
                                        y: 32
                                    },


                                ]*/
            }],
            credits: {
                enabled: false // Desactiva los créditos de Highcharts
            }
        });
    </script>


@endsection
