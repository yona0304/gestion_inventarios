@extends('layouts.layout')

@section('title', 'Inicio - INGICAT')

@section('content')
    {{-- <style>
        #container {
    height: 400px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
    </style> --}}

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
    {{-- <script>
        Highcharts.chart('container2', {

        title: {
            text: 'Movimientos de Inventario',
            align: 'left'
        },

        subtitle: {
            text: 'Por Tipo de Movimiento en el Inventario',
            align: 'left'
        },

        yAxis: {
            title: {
                text: 'Cantidad de Ítems'
            }
        },

        xAxis: {
            accessibility: {
                rangeDescription: 'Rango: Enero a Diciembre 2024'
            },
            categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 0
            }
        },

        series: [{
            name: 'Ingresos',
            data: [12, 15, 20, 25, 30, 28, 31, 29, 26, 27, 24, 29]
        }, {
            name: 'Salidas',
            data: [8, 9, 10, 13, 15, 14, 16, 15, 13, 14, 11, 12]
        }, {
            name: 'Traslados',
            data: [5, 4, 6, 8, 9, 8, 10, 9, 8, 9, 7, 7]
        }, {
            name: 'Retornos',
            data: [1, 2, 2, 2, 3, 2, 2, 3, 2, 2, 1, 2]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

        });
    </script> --}}
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
            subtitle: {
                text: 'Source:<a href="https://www.mdpi.com/2072-6643/11/3/684/htm" target="_default">MDPI</a>'
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
            subtitle: {
                text: 'Source:<a href="https://www.mdpi.com/2072-6643/11/3/684/htm" target="_default">MDPI</a>'
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
