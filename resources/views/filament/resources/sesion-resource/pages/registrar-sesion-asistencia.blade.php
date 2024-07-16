<x-filament-panels::page>
    @if ($this->getRecord()->empleados()->count()===0)
    <div class="grid  place-content-center px-4">
        <div class="text-center">

            <h4 class="mt-6 text-2xl font-bold tracking-tight text-danger-700 sm:text-3xl">Uh-oh!</h4>
            <p class="text-gray-500">Aun no hay asistencia.</p>
            <div class="mt-5">
                {{$this->generarAsistenciaAction}}
            </div>
        </div>
    </div>
    @else
    <x-filament-tables::container>
        <div class="divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10">
            <table class="w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                <thead class="divide-y divide-gray-200 dark:divide-white/5">
                    <tr class="bg-gray-50 dark:bg-white/5">
                        <x-filament-tables::header-cell alignment="center">N°</x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>Alumno</x-filament-tables::header-cell>
                        <x-filament-tables::header-cell alignment="end">Asistencia</x-filament-tables::header-cell>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                    @foreach($this->getRecord()->empleados as $empleado)
                    <x-filament-tables::row>
                        <x-filament-tables::cell class="text-center">
                            <div class="px-3 py-4 text-sm leading-6 text-gray-950 dark:text-white">
                                {{ $loop->iteration }}
                            </div>
                        </x-filament-tables::cell>
                        <x-filament-tables::cell>
                            <div class="px-3 py-4 text-sm leading-6 text-gray-950 dark:text-white">
                                {{ $empleado->apellido_paterno }} {{ $empleado->apellido_materno }}, {{
                                $empleado->nombres }}
                            </div>
                        </x-filament-tables::cell>
                        <x-filament-tables::cell class="text-right" alignment="end">
                            <div class="flex flex-col items-end ">
                                <input type="checkbox" wire:model.live="asistencia.{{ $empleado->id }}.is_present"
                                    class="hidden" id="toggle-{{ $empleado->id }}">
                                <label for="toggle-{{ $empleado->id }}" class="cursor-pointer">
                                    <x-filament::loading-indicator class="h-7 w-7"
                                        wire:target="asistencia.{{ $empleado->id }}.is_present" wire:loading />
                                    <span wire:loading.remove wire:target="asistencia.{{ $empleado->id }}.is_present">
                                        @if($asistencia[$empleado->id]['is_present'])
                                        <x-tabler-circle-check class="h-7 w-7 text-green-700" />
                                        @else
                                        <x-tabler-circle-x class="h-7 w-7 text-red-700" />
                                        @endif
                                    </span>
                                </label>
                            </div>
                        </x-filament-tables::cell>
                    </x-filament-tables::row>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="es-table__footer-ctn border-t border-gray-200"></div>
    </x-filament-tables::container>
    @endif
    <x-filament-panels::form wire:submit="save">
        {{-- {{ $this->form }} --}}

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>
</x-filament-panels::page>