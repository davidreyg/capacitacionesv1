{!! $fontHtml !!}
<style>
    .default-template-container * {
        font-size: 0.7rem;
        /* margin-top: 1rem; */
        font-family: '{{ $fontFam }}', sans-serif;
    }
</style>
<x-pdf.container class="default-template-container">
    <x-pdf.metadata class="">
        {{-- TITULO --}}
        <div class="flex justify-center items-center">
            <div class="text-center max-w-2xl">
                <span class="text-2xl font-bold uppercase">FICHA DE LA ACCIÓN DE LA CAPACITACIÓN PROGRAMADO</span>
            </div>
        </div>
        {{-- <!-- Datos de la capacitacion y el proveedor --> --}}
        {{-- <div class="grid grid-rows-3 items-start mt-8 gap-3"> --}}
        <div class="flex justify-start gap-x-3 border-solid border-2">
            <p class="font-bold text-gray-800 ">
                Año:
            </p>
            <p class="">
                {{ $evento->fecha_inicio->format('Y') }}
            </p>
        </div>
        <div class="flex justify-start gap-x-3 border-solid border-2">
            <p class="font-bold text-gray-800">
                Codigo:
            </p>
            <p class="">
                {{ $evento->capacitacion->codigo }}
            </p>
        </div>
        <div class="flex justify-start gap-x-3 border-solid border-2">
            <p class="font-bold text-gray-800">
                Función de Perfil :
            </p>
            <p class=""></p>
        </div>
        <div class="flex justify-start gap-x-3 border-solid border-2">
            <p class="font-bold text-gray-800">
                Nombre de la capacitación:
            </p>
            <p class="">
                {{ $evento->capacitacion->nombre }}
            </p>
        </div>
        {{-- </div> --}}
    </x-pdf.metadata>

    <!-- Line Items Table -->
    <x-pdf.line-items class="default-template-line-items">
        @php
            $unidadesOrganicas = $evento
                ->empleados()
                ->with('unidadOrganica')
                ->get()
                ->groupBy('unidadOrganica.id')
                ->map(function ($group) {
                    return [
                        'id' => $group->first()->unidadOrganica->id,
                        'nombre' => $group->first()->unidadOrganica->nombre,
                        'cantidad' => $group->count(),
                    ];
                })
                ->values();
            $unidadesOrganicasString = $unidadesOrganicas
                ->map(function ($unidad) {
                    return "{$unidad['nombre']} ({$unidad['cantidad']})";
                })
                ->implode('; ');
            $cargos = $evento
                ->empleados()
                ->with('cargo')
                ->get()
                ->groupBy('cargo.id')
                ->map(function ($group) {
                    return [
                        'id' => $group->first()->cargo->id,
                        'nombre' => $group->first()->cargo->nombre,
                        'cantidad' => $group->count(),
                    ];
                })
                ->values();
            $cargosString = $cargos
                ->map(function ($unidad) {
                    return "{$unidad['nombre']} ({$unidad['cantidad']})";
                })
                ->implode('; ');
            $empleadosString = $evento->empleados->pluck('nombre_completo')->implode('; ');
        @endphp
        <div class="flex flex-col gap-y-3">
            <div class="flex flex-col border-solid border-2">
                <div class="border-solid border-2">
                    <span class="font-bold uppercase">UNIDAD(ES) ORGÁNICA(S)</span>
                </div>
                <div class="w-full border-solid border-2">
                    <p>{{ $unidadesOrganicasString }}</p>
                </div>
            </div>
            <div class="flex flex-col border-solid border-2">
                <div class="border-solid border-2">
                    <span class="font-bold uppercase">DESCRIPCIÓN DEL PUESTO(S)</span>
                </div>
                <p class="w-full border-solid border-2">{{ $cargosString }}</p>
            </div>
            <div class="grid grid-cols-2 border-solid border-2">
                <p class="font-bold text-gray-800 border-solid border-2">
                    Puesto :
                    <span class="font-normal">1</span>
                </p>
                <p class="font-bold text-gray-800 border-solid border-2">
                    N° de Puestos:
                    <span class="font-normal">{{ $unidadesOrganicas->count() }}</span>
                </p>
            </div>
            <p class="w-full border-solid border-2">{{ $empleadosString }}</p>
            {{-- DIVIDER --}}
            <div class="grid grid-cols-2 border-solid border-2">
                <p class="font-bold text-gray-800 border-solid border-2">
                    N° de Beneficiarios :
                    <span class="font-normal">{{ count($evento->empleados) }}</span>
                </p>
                <p class="font-bold text-gray-800 border-solid border-2">
                    TIPO DE CAPACITACIÓN:
                    <span class="font-normal">{{ $evento->capacitacion->tipo_capacitacion->nombre }}</span>
                </p>
            </div>
            <div class="grid grid-cols-2 border-solid border-2">
                <p class="font-bold text-gray-800 border-solid border-2">
                    TIPO DE ACCION DE CAPACITACIÓN :

                    @foreach ($evento->capacitacion->respuestas as $respuesta)
                        @if ($respuesta->item->grupo_item_id === 1)
                            <span class="font-normal">{{ $respuesta->valor }} - {{ $respuesta->nombre }}</span>
                        @endif
                    @endforeach
                </p>
                <p class="font-bold text-gray-800 border-solid border-2">
                    N° de Horas:
                    <span class="font-normal">{{ $evento->numero_horas }}</span>
                </p>
            </div>
            <div class="grid grid-cols-2 border-solid border-2">
                <p class="font-bold text-gray-800 border-solid border-2">
                    CÓDIGO PRIORIDAD :

                    @foreach ($evento->capacitacion->respuestas as $respuesta)
                        @if ($respuesta->item->grupo_item_id === 2)
                            <span class="font-normal">{{ $respuesta->valor }} - {{ $respuesta->nombre }}</span>
                        @endif
                    @endforeach
                </p>
                <p class="font-bold text-gray-800 border-solid border-2">
                    CRÉDITOS:
                    <span class="font-normal">{{ $evento->creditos }}</span>
                </p>
            </div>
            <p class="text-center font-bold border-solid border-2"> RANGO DE PERTINENCIA</p>
            <div class="grid grid-cols-2 border-solid border-2">
                @php
                    $totalValor = 0;
                @endphp
                @foreach ($evento->capacitacion->respuestas as $respuesta)
                    @if ($respuesta->item->grupo_item_id === 3)
                        @php
                            $totalValor += $respuesta->valor;
                        @endphp
                        <p class="font-bold text-gray-800 border-solid border-2">
                            {{ $respuesta->item->nombre }}:
                            <span class="font-normal">{{ $respuesta->valor }}</span>
                        </p>
                    @endif
                @endforeach
                <p class="font-bold text-gray-800 border-solid border-2">
                    Total:
                    <span class="font-normal">{{ $totalValor }}</span>
                </p>
            </div>
            {{-- DIVIDER --}}
            <div class="grid grid-rows-1 border-solid border-2">
                <p class="font-bold text-gray-800 border-solid border-2">
                    OBJETIVO DE APRENDIZAJE :
                    <span class="font-normal">{{ $evento->capacitacion->objetivo_aprendizaje }}</span>
                </p>
            </div>
            <div class="grid grid-rows-1 border-solid border-2">
                <p class="font-bold text-gray-800 border-solid border-2">
                    OBJETIVO DE DESEMPEÑO :
                    <span class="font-normal">{{ $evento->capacitacion->objetivo_desempeño }}</span>
                </p>
            </div>

            <div class="grid grid-cols-3 border-solid border-2">
                @php
                    $nivelesString = $evento->capacitacion->nivels->pluck('nombre')->implode(', ');
                @endphp
                <p class="font-bold text-gray-800 border-solid border-2">
                    NIVEL DE EVALUACIÓN :
                    <span class="font-normal">{{ $nivelesString }}</span>
                </p>
                <p class="font-bold text-gray-800 border-solid border-2">
                    MODALIDAD :
                    <span class="font-normal">{{ $evento->modalidad->nombre }}</span>
                </p>
                <p class="font-bold text-gray-800 border-solid border-2">
                    OPORTUNIDAD :
                    <span class="font-normal">{{ $evento->oportunidad->nombre }}</span>
                </p>
            </div>
            {{-- DIVIDER --}}
            <p class="text-center font-bold border-solid border-2">ESTIMACIÓN DE COSTOS DE LA ACCIÓN DE CAPACITACIÓN</p>
            <div class="grid grid-cols-4 justify-between items-center border-solid border-2">
                @php
                    $costoDirecto = $evento->costosDirectos->sum('valor');
                    $costoIndirecto = $evento->costosIndirectos->sum('valor');
                    $subTotal = $costoIndirecto + $costoDirecto;
                    $total = $subTotal * count($evento->empleados);
                @endphp
                <p class="font-bold text-gray-800 border-solid border-2">
                    COSTO DIRECTO:
                    <span class="font-normal">S/ {{ $costoDirecto }}</span>
                </p>
                <p class="font-bold text-gray-800 border-solid border-2">
                    COSTO INDIRECTO :
                    <span class="font-normal">S/ {{ $costoIndirecto }}</span>
                </p>
                <p class="font-bold text-gray-800 border-solid border-2">
                    SUB TOTAL :
                    <span class="font-normal">S/ {{ $subTotal }}</span>
                </p>
                <p class="font-bold text-gray-800 border-solid border-2">
                    TOTAL :
                    <span class="font-normal">S/ {{ $total }}</span>
                </p>
            </div>
            <div class="grid grid-cols-1 border-solid border-2">
                @foreach ($evento->capacitacion->respuestas as $respuesta)
                    @if ($respuesta->item->grupo_item_id === 4)
                        <p class="font-bold text-gray-800 border-solid border-2">
                            {{ $respuesta->item->nombre }}:
                            <span class="font-normal">{{ $respuesta->valor }}</span>
                        </p>
                    @endif
                @endforeach
            </div>
        </div>

    </x-pdf.line-items>
</x-pdf.container>
