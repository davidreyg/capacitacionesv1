{!! $fontHtml !!}
<style>
    .default-template-container * {
        /* font-size: 1.2rem; */
        /* margin-top: 1rem; */
        font-family: '{{ $fontFam }}', sans-serif;
    }
</style>
<x-pdf.container class="default-template-container">
    <x-pdf.metadata class="">
        {{-- TITULO --}}
        <div class="flex justify-center items-center">
            <div class="text-center max-w-2xl">
                <span class="text-3xl font-bold uppercase">REGISTRO DE ESTADISTICAS DE SEGURIDAD Y SALUD EN EL
                    TRABAJO</span>
                @if ($reportSettings->sub_header)
                    <p>{{ $reportSettings->sub_header }}</p>
                @endif
            </div>

        </div>
    </x-pdf.metadata>

    <!-- Line Items Table -->
    <x-pdf.line-items class="default-template-line-items">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead class="text-sm  border-gray-300">
                <tr class="">
                    <th rowspan="2" class="border border-gray-300 p-2 text-center">FECHA</th>
                    <th rowspan="2" class="border border-gray-300 p-2 text-center">N° Accidentes Mortales</th>
                    <th rowspan="2" class="border border-gray-300 p-2 text-center">N° accidentes de trabajo leve</th>
                    <th colspan="6" class="border border-gray-300 p-2 text-center">Solo para accidentes
                        incapacitantes</th>
                    <th colspan="4" class="border border-gray-300 p-2 text-center">Enfermedades ocupacionales</th>
                    <th rowspan="2" class="border border-gray-300 p-2 text-center">N° incidentes peligrosos</th>
                    <th rowspan="2" class="border border-gray-300 p-2 text-center">N° incidentes</th>
                    <th rowspan="2" class="border border-gray-300 p-2 text-center">Area / EE. SS.</th>
                </tr>
                <tr class="">
                    <th class="border border-gray-300 p-2 text-right">N° Accid. Trab. Incap.</th>
                    <th class="border border-gray-300 p-2 text-center">Total Hombre Horas Trabajadas</th>
                    <th class="border border-gray-300 p-2 text-center">Indice de Frecuencia</th>
                    <th class="border border-gray-300 p-2 text-center">N° dias perdidos</th>
                    <th class="border border-gray-300 p-2 text-center">Indice de gravedad</th>
                    <th class="border border-gray-300 p-2 text-center">Indice de accidentabilidad</th>

                    <th class="border border-gray-300 p-2 text-center">N° de enfermedad ocupacional</th>
                    <th class="border border-gray-300 p-2 text-center">N° de trabajadores expuestos al agente</th>
                    <th class="border border-gray-300 p-2 text-center">Tasa de incidencia</th>
                    <th class="border border-gray-300 p-2 text-center">N° de trabajadores con cancer profesional</th>
                </tr>
            </thead>
            <tbody class="text-xs border-gray-300 leading-8">
                @foreach ($datos as $key => $data)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 text-center font-semibold p-2">{{ $key }}</td>
                        <td class="border border-gray-300 text-center font-semibold p-2">{{ $data['mortales'] }}</td>
                        <td class="border border-gray-300 text-center font-semibold p-2">{{ $data['leves'] }}</td>
                        <td class="border border-gray-300 text-center font-semibold p-2">{{ $data['incapacitantes'] }}
                        <td class="border border-gray-300 text-center font-semibold p-2">{{ $data['HORAS_TRABAJADAS'] }}
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            {{ $data['indice_frecuencia'] }}
                        </td>
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            {{ $data['dias_perdidos'] }}
                        </td>
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            {{ $data['indice_gravedad'] }}
                        </td>
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            {{ $data['indice_accidentabilidad'] }}
                        </td>
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            {{ $data['enfermedad_ocupacional'] }}
                        </td>
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            {{ $data['expuestos_agente'] }}
                        </td>
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            {{ $data['tasa_incidencia'] }}
                        </td>
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            -
                        </td>
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            {{ $data['incidentes'] }}
                        </td>
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            {{ $data['accidentes'] }}
                        </td>
                        <td class="border border-gray-300 text-center font-semibold p-2">
                            {{ $data['establecimientos'] }} /{{ $data['unidades_organicas'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-pdf.line-items>
</x-pdf.container>
