<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    {!! $fontHtml !!}
    <style>
        .default-template-container * {
            font-size: 0.7rem;
            /* margin-top: 1rem; */
            font-family: '{{ $fontFam }}', sans-serif;
        }
    </style>

    <link type="text/css" rel="stylesheet" href="pdf.css">
    @vite('resources/css/pdf/pdf.css')

</head>

<body class="antialiased">
    <x-pdf.container class="default-template-container">
        <x-pdf.metadata class="">
            {{-- TITULO --}}
            <div class="flex flex-col justify-center items-center">
                <div class="text-center max-w-2xl">
                    <span class="text-xl font-bold uppercase">FORMATO</span>
                </div>
                <div class="text-center max-w-2xl">
                    <span class="text-lg font-bold uppercase">REGISTRO DE ACCIDENTES DE TRABAJO</span>
                </div>
            </div>
        </x-pdf.metadata>

        <!-- Line Items Table -->
        <x-pdf.line-items class="default-template-line-items">
            {{-- // PASO 1 --}}
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-2 py-1 border border-gray-300 text-left" colspan="5">1. DATOS DEL EMPLEADOR
                            PRINCIPAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300">RAZÓN O DENOMINACION SOCIAL</td>
                        <td class="px-2 py-1 border border-gray-300">RUC</td>
                        <td class="px-2 py-1 border border-gray-300">DOMICILIO</td>
                        <td class="px-2 py-1 border border-gray-300">TIPO DE ACTIVIDAD ECONOMICA</td>
                        <td class="px-2 py-1 border border-gray-300">N° DE TRABAJADORES EN EL CENTRO LABORAL</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->establecimientoPrincipal->nombre }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->establecimientoPrincipal->ruc }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->establecimientoPrincipal->direccion }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->establecimientoPrincipal->anexoUnoActividadEconomica->descripcion }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ count($registroAccidente->establecimientoPrincipal->empleados) }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300" colspan="5">
                            COMPLETAR SOLO EN CASO QUE LAS ACTIVIDADES DEL EMPLEADOR SEAN CONSIDERADAS DE ALTO RIESGO
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300">
                            Nº TRABAJADORES AFILIADOS AL SCTR
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            Nº TRABAJADORES NO AFILIADOS AL SCTR
                        </td>
                        <td class="px-2 py-1 border border-gray-300" colspan="3">
                            NOMBRE DE LA ASEGURADORA
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->principal_trabajadores_sctr }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->principal_trabajadores_no_sctr }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300" colspan="3">
                            {{ $registroAccidente->principal_nombre_aseguradora }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300" colspan="5">
                            Completar sólo si contrata servicios de intermediación o tercerización:
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- PASO 2 --}}
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-2 py-1 border border-gray-300 text-left" colspan="5">
                            2. DATOS DEL EMPLEADOR DE INTERMEDIACION, TERCERIZACION, CONTRATISTA, SUBCONTRATISTA, OTROS:
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300">RAZÓN O DENOMINACION SOCIAL</td>
                        <td class="px-2 py-1 border border-gray-300">RUC</td>
                        <td class="px-2 py-1 border border-gray-300">DOMICILIO</td>
                        <td class="px-2 py-1 border border-gray-300">TIPO DE ACTIVIDAD ECONOMICA</td>
                        <td class="px-2 py-1 border border-gray-300">N° DE TRABAJADORES EN EL CENTRO LABORAL</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->establecimientoIntermediario->nombre }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->establecimientoIntermediario->ruc }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->establecimientoIntermediario->direccion }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->establecimientoIntermediario->anexoUnoActividadEconomica->descripcion }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ count($registroAccidente->establecimientoIntermediario->empleados) }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300" colspan="5">
                            COMPLETAR SOLO EN CASO QUE LAS ACTIVIDADES DEL EMPLEADOR SEAN CONSIDERADAS DE ALTO RIESGO
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300">
                            Nº TRABAJADORES AFILIADOS AL SCTR
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            Nº TRABAJADORES NO AFILIADOS AL SCTR
                        </td>
                        <td class="px-2 py-1 border border-gray-300" colspan="3">
                            NOMBRE DE LA ASEGURADORA
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->intermediario_trabajadores_sctr }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->intermediario_trabajadores_no_sctr }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300" colspan="3">
                            {{ $registroAccidente->intermediario_nombre_aseguradora }}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- PASO 3 --}}
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-2 py-1 border border-gray-300 text-left" colspan="9">
                            3. DATOS DEL TRABAJADOR:
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300" colspan="6">APELLIDOS Y NOMBRES DEL TRABAJADOR
                            ACCIDENTADO</td>
                        <td class="px-2 py-1 border border-gray-300" colspan="2">Nº DNI / CE</td>
                        <td class="px-2 py-1 border border-gray-300">EDAD</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300" colspan="6">
                            {{ $registroAccidente->empleado->nombre_completo }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300" colspan="2">
                            {{ $registroAccidente->empleado->numero_documento }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ \Carbon\Carbon::parse($registroAccidente->empleado->fecha_nacimiento)->age }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300">
                            SEDE
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            AREA
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            PUESTO DE TRABAJO
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            ANTIGÜEDAD EN EL PUESTO
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            SEXO (M / F)
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            TURNO (D / T / N)
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            TIPO DE CONTRATO
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            TIEMPO DE EXPERIENCIA EN EL PUESTO
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            Nº HORAS TRABAJADAS
                        </td>

                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->empleado->establecimiento->nombre }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->empleado->unidadOrganica->nombre }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->empleado->cargo->nombre }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->empleado->antiguedad_puesto }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->empleado->sexo }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->empleado->turno }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->empleado->tipoPlanilla->nombre }}
                        </td>
                        <td class="px-2 py-1 border border-gray-300">
                            {{ $registroAccidente->empleado->tiempo_experiencia }}
                        </td>
                        <td class="px-4 py-2 border border-gray-300">
                            {{ \Carbon\Carbon::parse($registroAccidente->empleado->fecha_alta)->diffInHours(\Carbon\Carbon::now()) }}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- PASO 4 --}}
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-2 py-1 border border-gray-300 text-left" colspan="16">
                            4. INVESTIGACION DEL ACCIDENTE DE TRABAJO
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="border border-gray-300 px-2 py-1 text-center">FECHA Y HORA
                            DE LA OCURRENCIA DEL ACCIDENTE</td>
                        <td colspan="3" class="border border-gray-300 px-2 py-1 text-center">FECHA DE
                            INICIO DE LA INVESTIGACIÓN</td>
                        <td rowspan="2" colspan="9" class="border border-gray-300 px-2 py-1 text-center">LUGAR
                            EXACTO
                            DONDE OCURRIÓ EL ACCIDENTE</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1 text-center">DÍA</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">MES</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">AÑO</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">HORA</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">DÍA</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">MES</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">AÑO</td>
                    </tr>
                    <tr>
                        {{-- Partes de fecha_ocurrencia_accidente --}}
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ \Carbon\Carbon::parse($registroAccidente->fecha_hora_accidente)->day }}</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ \Carbon\Carbon::parse($registroAccidente->fecha_hora_accidente)->month }}</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ \Carbon\Carbon::parse($registroAccidente->fecha_hora_accidente)->year }}</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ \Carbon\Carbon::parse($registroAccidente->fecha_hora_accidente)->format('H:i') }}</td>

                        {{-- Partes de fecha_inicio --}}
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ \Carbon\Carbon::parse($registroAccidente->fecha_inicio_investigacion)->day }}</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ \Carbon\Carbon::parse($registroAccidente->fecha_inicio_investigacion)->month }}</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ \Carbon\Carbon::parse($registroAccidente->fecha_inicio_investigacion)->year }}</td>

                        {{-- Lugar del accidente (puede ser otro campo o vacío) --}}
                        <td class="border border-gray-300 px-2 py-1 text-center" colspan="9">
                            {{ $registroAccidente->lugar_accidente }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1 text-center" colspan="6">MARCAR CON (X)
                            GRAVEDAD DEL ACCIDENTE DE TRABAJO</td>
                        <td class="border border-gray-300 px-2 py-1 text-center" colspan="8">MARCAR CON (X) GRADO
                            DEL ACCIDENTE INCAPACITANTE (DE SER EL CASO)</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">Nº DIAS DE DESCANSO MEDICO</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">Nº TRABAJADORES AFECTADOS</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1 text-center">ACCIDENTE LEVE</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ $registroAccidente->gravedad_accidente === App\Enums\RegistroAccidente\GravedadEnum::ACCIDENTE_LEVE ? 'X' : '' }}
                        </td>
                        <td class="border border-gray-300 px-2 py-1 text-center">ACCIDENTE INCAPACITANTE</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ $registroAccidente->gravedad_accidente === App\Enums\RegistroAccidente\GravedadEnum::ACCIDENTE_INCAPACITANTE ? 'X' : '' }}
                        </td>
                        <td class="border border-gray-300 px-2 py-1 text-center">MORTAL</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ $registroAccidente->gravedad_accidente === App\Enums\RegistroAccidente\GravedadEnum::ACCIDENTE_MORTAL ? 'X' : '' }}
                        </td>

                        <td class="border border-gray-300 px-2 py-1 text-center">TOTAL TEMPORAL</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ $registroAccidente->grado_accidente === App\Enums\RegistroAccidente\GradoAccidenteEnum::TOTAL_TEMPORAL ? 'X' : '' }}
                        </td>
                        <td class="border border-gray-300 px-2 py-1 text-center">PARCIAL TEMPORAL</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ $registroAccidente->grado_accidente === App\Enums\RegistroAccidente\GradoAccidenteEnum::PARCIAL_TEMPORAL ? 'X' : '' }}
                        </td>
                        <td class="border border-gray-300 px-2 py-1 text-center">PARCIAL PERMANENTE</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ $registroAccidente->grado_accidente === App\Enums\RegistroAccidente\GradoAccidenteEnum::PARCIAL_PERMANENTE ? 'X' : '' }}
                        </td>
                        <td class="border border-gray-300 px-2 py-1 text-center">TOTAL PERMANENTE</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ $registroAccidente->grado_accidente === App\Enums\RegistroAccidente\GradoAccidenteEnum::TOTAL_PERMANENTE ? 'X' : '' }}
                        </td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ $registroAccidente->dias_descanso }}
                        </td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ $registroAccidente->trabajadores_afectados }}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- PASO 5 --}}
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-2 py-1 border border-gray-300 text-left">
                            5. DESCRIPCION DEL ACCIDENTE DE TRABAJO
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ $registroAccidente->descripcion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- PASO 6 --}}
            @php
                $causasAgrupadas = $registroAccidente->registroAccidenteCausas->groupBy(['grupo', 'tipo']);
            @endphp
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-2 py-1 border border-gray-300 text-left">
                            6. DESCRIPCION DE LAS CAUSAS QUE ORIGINARON EL ACCIDENTE DE TRABAJO
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">
                            <ol class="list-decimal list-inside">
                                @foreach ($causasAgrupadas as $key => $grupo)
                                    <li>
                                        {{ $key }}
                                        <ol class="list-disc list-inside ml-4">
                                            @foreach ($grupo as $key => $subGrupo)
                                                <li>
                                                    {{ $key }}
                                                    <ol class="list-disc list-inside ml-8">
                                                        @foreach ($subGrupo as $key => $value)
                                                            <li>
                                                                {{ $value->descripcion }}

                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- PASO 7 --}}
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-2 py-1 border border-gray-300 text-left" colspan="6">
                            7. MEDIDAS CORRECTIVAS
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1" rowspan="2">
                            DESCRIPCION DE LA MEDIDA CORRECTIVA
                        </td>
                        <td class="border border-gray-300 px-2 py-1" rowspan="2">
                            RESPONSABLE
                        </td>
                        <td class="border border-gray-300 px-2 py-1 text-center" colspan="3">
                            FECHA DE EJECUCION
                        </td>
                        <td class="border border-gray-300 px-2 py-1" rowspan="2">
                            Estado de implementación de la medida correctiva (REALIZADA, PENDIENTE, EN PROCESO)
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">DIA</td>
                        <td class="border border-gray-300 px-2 py-1">MES</td>
                        <td class="border border-gray-300 px-2 py-1">AÑO</td>
                    </tr>
                    @foreach ($registroAccidente->registroAccidenteMedidas as $medida)
                        <tr>
                            <td class="border border-gray-300 px-2 py-1">{{ $medida->nombre }}</td>
                            <td class="border border-gray-300 px-2 py-1">{{ $medida->responsable }}</td>
                            <td class="border border-gray-300 px-2 py-1 text-center">
                                {{ \Carbon\Carbon::parse($medida->fecha_ejecucion)->day }}</td>
                            <td class="border border-gray-300 px-2 py-1 text-center">
                                {{ \Carbon\Carbon::parse($medida->fecha_ejecucion)->month }}</td>
                            <td class="border border-gray-300 px-2 py-1 text-center">
                                {{ \Carbon\Carbon::parse($medida->fecha_ejecucion)->year }}</td>
                            <td class="border border-gray-300 px-2 py-1">{{ $medida->estado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- PASO 8 --}}
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-2 py-1 border border-gray-300 text-left" colspan="8">
                            8. RESPONSABLE DEL REGISTRO Y DE LA INVESTIGACION
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registroAccidente->registroAccidenteResponsables as $responsable)
                        <tr>
                            <td class="border border-gray-300 px-2 py-1">NOMBRE:</td>
                            <td class="border border-gray-300 px-2 py-1">{{ $responsable->empleado->nombre_completo }}
                            <td class="border border-gray-300 px-2 py-1">CARGO:</td>
                            <td class="border border-gray-300 px-2 py-1">{{ $responsable->empleado->cargo->nombre }}
                            <td class="border border-gray-300 px-2 py-1">FECHA:</td>
                            <td class="border border-gray-300 px-2 py-1">{{ $responsable->fecha }}
                            <td class="border border-gray-300 px-2 py-1">FIRMA:</td>
                            <td class="border border-gray-300 px-2 py-1 text-center">_________________</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- PASO 9 --}}
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-2 py-1 border border-gray-300 text-center">
                            ELABORADO POR:
                        </th>
                        <th class="px-2 py-1 border border-gray-300 text-center">
                            REVISADO POR:
                        </th>
                        <th class="px-2 py-1 border border-gray-300 text-center">
                            APROBADO POR:
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="h-24">
                        <td class="border border-gray-300 px-2 py-1 text-center"></td>
                        <td class="border border-gray-300 px-2 py-1 text-center"></td>
                        <td class="border border-gray-300 px-2 py-1 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            Responsable de Seguridad y Salud en el Trabajo
                        </td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            Comité de Seguridad y Salud en el Trabajo
                        </td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            Dirección Administrativa
                        </td>
                    </tr>
                </tbody>
            </table>
        </x-pdf.line-items>
    </x-pdf.container>

</body>

</html>
