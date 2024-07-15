<x-filament-panels::page>
    @if ($this->getRecord()->evaluacions()->count()===0)
    <div class="grid  place-content-center px-4">
        <div class="text-center">

            <h4 class="mt-6 text-2xl font-bold tracking-tight text-danger-700 sm:text-3xl">Uh-oh!</h4>
            <p class="text-gray-500">Aun no hay evaluaciones.</p>
            <div class="mt-5">
                {{$this->generarEvaluacionAction}}
            </div>
        </div>
    </div>
    @else
    @php
    $matrizNotas = \App\Actions\Evento\ObtenerEvaluacionesPorEvento::make()->handle($this->getRecord());
    @endphp
    <x-filament-tables::container>
        <div class="divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10">
            <table class="w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                <thead class="divide-y divide-gray-200 dark:divide-white/5">
                    <tr class="bg-gray-50 dark:bg-white/5">
                        <x-filament-tables::header-cell alignment="center">N°</x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>Alumno</x-filament-tables::header-cell>
                        @foreach ($this->getRecord()->criterioEvaluacions as $criterioEvaluacion)
                        <x-filament-tables::header-cell alignment="end">
                            {{$criterioEvaluacion->nombre}}
                            @if ($criterioEvaluacion->valor!==null) ( {{$criterioEvaluacion->valor}}% ) @endif
                        </x-filament-tables::header-cell>
                        @endforeach
                        <x-filament-tables::header-cell alignment="end">Promedio</x-filament-tables::header-cell>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                    @foreach($matrizNotas as $row)
                    <x-filament-tables::row>
                        <x-filament-tables::cell class="text-center">
                            <div class="px-3 py-4 text-sm leading-6 text-gray-950 dark:text-white">
                                {{ $loop->iteration }}
                            </div>
                        </x-filament-tables::cell>
                        <x-filament-tables::cell>
                            <div class="px-3 py-4 text-sm leading-6 text-gray-950 dark:text-white">
                                {{ $row['alumno'] }}
                            </div>
                        </x-filament-tables::cell>
                        @foreach ($row['notas'] as $index=> $nota)
                        <x-filament-tables::cell class="text-right">
                            <div class="flex flex-col items-end">
                                @if ($criterioSeleccionado === $index)
                                <x-filament::input.wrapper class="w-auto"
                                    :valid="! $errors->has(sprintf('data.%s.nota', $row['empleado_id']))">
                                    <x-filament::input type="text" wire:model="data.{{ $row['empleado_id'] }}.nota"
                                        value="{{$nota}}" />
                                </x-filament::input.wrapper>
                                @error(sprintf('data.%s.nota', $row['empleado_id']))
                                <div class="text-red-500 text-sm w-auto text-wrap">{{ $message }}</div>
                                @enderror
                                {{-- <div class="px-3 py-4 text-sm leading-6 text-red-600">
                                    <input type="text" value="{{$nota}}" class="text-blue-500"
                                        wire:model="data.{{ $row['empleado_id'] }}">
                                </div> --}}
                                @else
                                <div class="px-3 py-4 text-sm leading-6 text-gray-950 dark:text-white">
                                    {{ $nota }}
                                </div>
                                @endif
                            </div>

                        </x-filament-tables::cell>
                        @endforeach
                        <x-filament-tables::cell class="text-right">
                            <div class="px-3 py-4 text-sm leading-6 text-gray-950 dark:text-white">
                                {{ $row['promedio'] }}
                            </div>
                        </x-filament-tables::cell>
                    </x-filament-tables::row>
                    @endforeach
                    <x-filament-tables::row>
                        <x-filament-tables::header-cell alignment="center"></x-filament-tables::header-cell>
                        <x-filament-tables::header-cell></x-filament-tables::header-cell>
                        @foreach ($this->getRecord()->criterioEvaluacions as $criterioEvaluacion)
                        <x-filament-tables::header-cell alignment="end">
                            @if($criterioEvaluacion->id != $criterioSeleccionado)
                            <button
                                class="inline-block p-1.5 text-center text-white transition bg-warning-700 rounded-full shadow ripple hover:shadow-lg hover:bg-warning-800 focus:outline-none"
                                wire:click="editarCriterioEvaluacion({{$criterioEvaluacion->id}})"
                                wire:loading.attr="disabled">
                                <x-tabler-edit class=" h-5 w-5 text-white" wire:loading.remove
                                    wire:target="editarCriterioEvaluacion({{$criterioEvaluacion->id}})" />

                                <x-filament::loading-indicator class="h-5 w-5 text-white"
                                    wire:target="editarCriterioEvaluacion({{$criterioEvaluacion->id}})" wire:loading />

                            </button>
                            @else
                            <div>
                                <button
                                    class="inline-block p-1.5 text-center text-white transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none"
                                    wire:click="guardarCriterioEvaluacion({{$criterioEvaluacion->id}})"
                                    wire:loading.attr="disabled">
                                    <x-tabler-device-floppy class="h-5 w-5 text-white" wire:loading.remove
                                        wire:target="guardarCriterioEvaluacion({{$criterioEvaluacion->id}})" />

                                    <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading
                                        wire:target="guardarCriterioEvaluacion({{$criterioEvaluacion->id}})" />

                                </button>
                                <button
                                    class="inline-block p-1.5 text-center text-white transition bg-danger-700 rounded-full shadow ripple hover:shadow-lg hover:bg-danger-800 focus:outline-none"
                                    wire:click="cancelarEdicionCriterioEvaluacion" wire:loading.attr="disabled">
                                    <x-tabler-circle-x class=" h-5 w-5 text-white" wire:loading.remove
                                        wire:target="cancelarEdicionCriterioEvaluacion" />

                                    <x-filament::loading-indicator class="h-5 w-5 text-white"
                                        wire:target="cancelarEdicionCriterioEvaluacion" wire:loading />

                                </button>
                            </div>
                            @endif
                        </x-filament-tables::header-cell>
                        @endforeach
                        <x-filament-tables::header-cell alignment="end">Promedio</x-filament-tables::header-cell>

                    </x-filament-tables::row>
                </tbody>
            </table>
        </div>
        <div class="es-table__footer-ctn border-t border-gray-200"></div>
    </x-filament-tables::container>
    @endif
</x-filament-panels::page>