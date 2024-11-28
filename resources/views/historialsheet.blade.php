<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
            font-size: 8;
        }

        th,
        td {
            border: 3px solid black;
            text-align: center;
            padding: 5px;
            border: 2px solid black;
        }

        th {
            background-color: #A3A3A3FF;
        }

        .header-table,
        .header-table td {
            border: none;
        }
    </style>

<body>
    <table class="header-table">
        <thead>
            <tr>
                <th style="border: 1px solid black;">ID
                </th>
                <th style="border: 1px solid black;">Codigo Interno
                </th>
                <th style="border: 1px solid black;">Marca
                </th>
                <th style="border: 1px solid black;">Modelo
                </th>
                <th style="border: 1px solid black;">Hostname
                </th>
                <th style="border: 1px solid black;">Tipo Equipo
                </th>
                <th style="border: 1px solid black;">Serial
                </th>
                <th style="border: 1px solid black;">Procesador
                </th>
                <th style="border: 1px solid black;">Disco
                </th>
                <th style="border: 1px solid black;">Disco 2
                </th>
                <th style="border: 1px solid black;">RAM
                </th>
                <th style="border: 1px solid black;">Software Instalado
                </th>
                <th style="border: 1px solid black;">Licencias
                </th>
                <th style="border: 1px solid black;">Sistema Operativo
                </th>
                <th style="border: 1px solid black;">Licencia
                </th>
                <th style="border: 1px solid black;">Antivirus
                </th>
                <th style="border: 1px solid black;">Version y Licencia
                </th>
                <th style="border: 1px solid black;">Observaciones
                </th>
                <th style="border: 1px solid black;">fecha_registro
                </th>
                <th style="border: 1px solid black;">Estado
                </th>
            </tr>
        </thead>

        <tbody>
            @php
                use Carbon\Carbon;
                Carbon::setLocale('es');
                $fecha_inicial = Carbon::parse($fecha_inicial);
                $fecha_final = Carbon::parse($fecha_final);

                $contador = 1;
            @endphp
            @foreach ($historiales as $historial)
                @php
                    $fechaHistorial = Carbon::parse($historial->fecha_registro);
                @endphp
                @if ($fechaHistorial->between($fecha_inicial, $fecha_final))
                    <tr>
                        <td>{{ $contador }}</td>
                        <td>{{ $historial->producto->codigo_interno }}</td>
                        <td>{{ $historial->marca }}</td>
                        <td>{{ $historial->modelo }}</td>
                        <td>{{ $historial->hostname }}</td>
                        <td>{{ $historial->t_equipo }}</td>
                        <td>{{ $historial->serial }}</td>
                        <td>{{ $historial->procesador }}</td>
                        <td>{{ $historial->disco }}</td>
                        <td>{{ $historial->disco2 }}</td>
                        <td>{{ $historial->ram }}</td>
                        <td>{{ $historial->s_instalado }}</td>
                        <td>{{ $historial->licencias }}</td>
                        <td>{{ $historial->s_operativo }}</td>
                        <td>{{ $historial->licencia }}</td>
                        <td>{{ $historial->antivirus }}</td>
                        <td>{{ $historial->version_licencia }}</td>
                        <td>{{ $historial->observaciones }}</td>
                        <td>{{ $historial->fecha_registro }}</td>
                        <td>{{ $historial->estado }}</td>
                    </tr>

                    @php
                        $contador++;
                    @endphp
                @endif
            @endforeach
        </tbody>

    </table>
</body>

</html>
