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
                <span class="text-3xl font-bold uppercase">{{ $reportSettings->header }}</span>
                @if ($reportSettings->sub_header)
                    <p>{{ $reportSettings->sub_header }}</p>
                @endif
            </div>

        </div>
        {{-- <!-- Datos de la capacitacion y el proveedor --> --}}
        <div class="grid grid-cols-3 items-start mt-8 gap-x-3">
            <div>
                <p class="font-bold text-gray-800">
                    Código :
                </p>
                <p class="">
                    CODIGO1
                </p>
            </div>

            <div>
                <p class="font-bold text-gray-800">
                    Acción de la capacitacion:
                </p>
                <p class="">
                    {{ $datos->evento->nombre_capacitacion }}
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores officia odit corporis nesciunt at
                </p>
            </div>
            <div class="text-right">
                <p class="font-bold text-gray-800">
                    Proveedor :
                </p>
                <p class="">
                    {{ $datos->evento->proveedor }}
                </p>
            </div>
        </div>

        {{-- STATS --}}
        <div class="divider px-6">
            <x-tabler-inner-shadow-bottom-right class="h-16 w-16" />
        </div>
        <div class="flex justify-center">
            <div class="w-9/12 grid grid-cols-3 items-center gap-x-3 ">
                <div class="stats shadow text-center">
                    <div class="stat">
                        <div class="stat-figure text-amber-400">
                            <x-tabler-users class="inline-block h-8 w-8 stroke-current" />
                        </div>
                        <div class="stat-title">N° de participantes</div>
                        <div class="stat-value text-amber-400">{{ count($datos->empleados) }}</div>
                    </div>
                </div>
                <div class="stats shadow text-center">
                    <div class="stat">
                        <div class="stat-figure text-green-400">
                            <x-tabler-building class="inline-block h-8 w-8 stroke-current" />
                        </div>
                        <div class="stat-title">N° de Unidades Organicas</div>
                        <div class="stat-value text-green-400">{{ count($datos->empleados) }}</div>
                    </div>
                </div>
                <div class="stats shadow text-center">
                    <div class="stat">
                        <div class="stat-figure text-blue-400">
                            <x-tabler-briefcase class="inline-block h-8 w-8 stroke-current" />
                        </div>
                        <div class="stat-title">N° de Unidades Organicas</div>
                        <div class="stat-value text-blue-400">{{ count($datos->empleados) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </x-pdf.metadata>

    <!-- Line Items Table -->
    <x-pdf.line-items class="default-template-line-items">
        <table class="table-fixed w-full">
            <thead class="text-sm border-b-2">
                <tr class="">
                    <th class="p-2 text-center w-16">N°</th>
                    <th class="p-2 text-left">Apellidos y Nombres</th>
                    <th class="p-2 text-right w-72 pr-10">Unidad Orgánica</th>
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
                        <td class="text-right p-2 pr-10">{{ $empleado->unidadOrganica }} </td>
                        <td class="text-center whitespace-nowrap p-2 relative">
                            <div class="absolute bottom-2 left-0 w-full border-b-2 "></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-pdf.line-items>
</x-pdf.container>
