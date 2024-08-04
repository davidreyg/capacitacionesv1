<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    @auth
        @if (auth()->user()->isEmpleado())
            <div class="flex justify-center gap-x-4 rounded-lg">
                <span class="flex items-center gap-x-2">
                    <span class="text-sm font-semibold px-2.5 rounded">
                        Código:
                    </span>
                    <x-filament::badge color="success">
                        <span class="font-extrabold text-lg"> {{ auth()->user()->empleado->establecimiento->codigo }}</span>
                    </x-filament::badge>
                </span>
                <span class="flex items-center gap-x-2">
                    <span class="text-sm font-semibold px-2.5 rounded">
                        Entidad:
                    </span>
                    <x-filament::badge color="info" size="lg">
                        <span class="font-extrabold text-lg">{{ auth()->user()->empleado->establecimiento->nombre }}</span>
                    </x-filament::badge>
                </span>
            </div>
        @else
            <div class="flex justify-center gap-x-4 rounded-lg">
                <span class="flex items-center gap-x-2">
                    <span class="text-sm font-semibold px-2.5 rounded">
                        Proveedor:
                    </span>
                    <x-filament::badge color="success">
                        <span class="font-extrabold text-lg"> {{ auth()->user()->proveedor->razon_social }}</span>
                    </x-filament::badge>
                </span>
            </div>
        @endif
    @endauth
</div>
