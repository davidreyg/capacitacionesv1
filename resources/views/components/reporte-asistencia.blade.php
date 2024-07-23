@php
    $logo = \Storage::url($generalSettings->brand_logo);
@endphp
{!! $fontHtml !!}
<style>
    .default-template-container * {
        /* font-size: 1.2rem; */
        /* margin-top: 1rem; */
        font-family: '{{ $fontFam }}', sans-serif;
    }

    .tabla-metadata,
    .tabla-metadata tr,
    .tabla-metadata tbody,
    .tabla-metadata td {
        border: none;
        font-size: 1.2rem;
    }

    .tabla-sesion,
    .tabla-sesion tr,
    .tabla-sesion tbody,
    .tabla-sesion td {
        border: none;
        font-size: 1.2rem;
    }

    .tabla-datos td,
    .tabla-datos th {
        font-size: 1.2rem;
        /* text-align: center; */
        vertical-align: middle;
        word-wrap: break-word;
        /* Permite el ajuste de palabras largas */
        word-break: break-all;
        /* Permite el ajuste de palabras largas */
        white-space: normal;
        /* Permite el ajuste de texto */
    }
</style>
<x-pdf.container class="default-template-container">

    <x-pdf.metadata class="default-template-metadata">
        <table class="tabla-metadata  w-full table-fixed">
            <tbody>
                <tr>
                    <td class="py-2">
                        <span class="text-3xl font-bold uppercase">{{ $reportSettings->header }}</span>

                    </td>

                    <td class="py-2 text-right">Fecha de la Sesión: {{ $datos->sesion->fecha }}</td>
                </tr>
                <tr>
                    @if ($reportSettings->sub_header)
                        <td class="py-2">
                            <h2 class="text-sm text-gray-600 dark:text-gray-400">{{ $reportSettings->sub_header }}</h2>
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
        <hr class="uk-divider-icon">
        {{-- DATOS DE LA SESION --}}
        <table class="tabla-sesion table-fixed w-full">
            <tbody>
                <tr class="text-xl">
                    <td class="py-2 font-semibold">Acción de la capacitacion:
                        <span class="font-normal">{{ $datos->evento->nombre_capacitacion }}</span>
                    </td>
                    <td class="py-2 text-right font-semibold">Proveedor:
                        <span class="font-normal"> {{ $datos->evento->proveedor }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">Nro. de asistentes: <span class="font-normal"
                            style="color: red">{{ count($datos->empleados) }}</span></td>
                </tr>
            </tbody>
        </table>
    </x-pdf.metadata>

    <!-- Line Items Table -->
    <x-pdf.line-items class="default-template-line-items">
        <table class="tabla-datos w-full text-left table-fixed">
            <thead class="text-sm leading-8 bg-purple-300">
                <tr class="text-red">
                    <th class="p-2 text-center w-16">N°</th>
                    <th class="p-2 text-left">Apellidos y Nombres</th>
                    <th class="p-2 text-right w-72">Unidad Orgánica</th>
                    <th class="p-2 text-center w-52">Firma</th>
                </tr>
            </thead>
            <tbody class="text-xs border-gray-300 leading-8">
                @foreach ($datos->empleados as $empleado)
                    <tr class="hover:bg-gray-50">
                        <td class="text-center font-semibold p-2">{{ $loop->iteration }}</td>
                        <td class="text-left p-2">
                            {{ $empleado->nombres }}
                        </td>
                        <td class="text-right p-2">{{ $empleado->unidadOrganica }} </td>
                        <td class="text-center whitespace-nowrap p-2" style="vertical-align: bottom">________________
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-pdf.line-items>

    <!-- Footer Notes -->
    <x-pdf.bottom class="default-template-footer">
        <p class="px-6">{{ $reportSettings->footer }}</p>
        <span class="border-t-2 my-2 border-gray-300 block w-full"></span>
        <h4 class="font-semibold px-6 mb-2">Observaciones</h4>
        <p class="px-6 break-words line-clamp-4">dummy</p>
    </x-pdf.bottom>
</x-pdf.container>
