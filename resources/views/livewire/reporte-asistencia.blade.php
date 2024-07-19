<x-pdf.container class="default-template-container">

    <x-pdf.header class="default-template-header border-b-2 p-6 pb-4">
        <div class="flex justify-between items-center w-full">
            <div class="w-1/2 text-left text-red-400">
                <div class="text-xs">
                    <h2 class="font-semibold">dummy</h2>
                </div>
            </div>
            <div class="w-1/2">
                {{-- @if($logo && $show_logo)
                <x-pdf.logo :src="$logo" />
                @endif --}}
            </div>
        </div>
    </x-pdf.header>

    <x-pdf.metadata class="default-template-metadata space-y-6">
        <div class="flex justify-between items-start ">
            <div>
                <h1 class="text-3xl font-light uppercase text-yellow-400">dummy</h1>
                {{-- @if ($subheader) --}}
                <h2 class="text-sm text-gray-600 dark:text-gray-400">dummy</h2>
                {{-- @endif --}}
            </div>
            <div class="flex justify-between items-center gap-3 bg-red-500">
                <div class="bg-red-500">
                    <h3 class="text-gray-600 dark:text-gray-400 font-medium tracking-tight text-center bg-red-500">
                        Día</h3>
                    <p class="text-base text-center font-bold">17</p>
                </div>
                <div>
                    <h3 class="text-gray-600 dark:text-gray-400 font-medium tracking-tight text-center">Mes</h3>
                    <p class="text-base text-center font-bold">Julio</p>
                </div>
                <div>
                    <h3 class="text-gray-600 dark:text-gray-400 font-medium tracking-tight text-center">Año</h3>
                    <p class="text-base font-bold text-center">2024</p>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-start">
            <!-- Billing Details -->
            <div class="text-xs">
                <h3 class="text-gray-600 dark:text-gray-400 font-medium tracking-tight mb-1">Acción de
                    Capacitación:
                    Curso de Ética</h3>
            </div>
            <div class="text-xs">
                <h3 class="text-gray-600 dark:text-gray-400 tracking-tight mb-1">Proveedor: Diris Lima Sur</h3>
            </div>
        </div>
    </x-pdf.metadata>

    <!-- Line Items Table -->
    <x-pdf.line-items class="default-template-line-items">
        <table class="w-full text-left table-fixed">
            <thead class="text-sm leading-8 bg-purple-300">
                <tr class="text-red">
                    <th class="px-3 w-10 text-left">N°</th>
                    <th class="px-3 text-left">Apellidos y Nombres</th>
                    <th class="px-3 w-25 text-right">Unidad Orgánica</th>
                    <th class="px-3 w-20 text-right pr-6">Firma</th>
                </tr>
            </thead>
            <tbody class="text-xs border-gray-300 leading-8">
                <tr class="hover:bg-gray-50">
                    <td class="text-left font-semibold px-3">1</td>
                    <td class="whitespace-nowrap max-w-xs truncate text-wrap px-3">
                        Rey Gutierrez, Neisser David
                    </td>
                    <td class="text-right">Area de Informática</td>
                    <td class="whitespace-nowrap signature-line px-3"></td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="text-left font-semibold px-3">2</td>
                    <td class="whitespace-nowrap max-w-xs truncate text-wrap px-3">
                        Mamani Quispe, Carlos Josué
                    </td>
                    <td class="text-right">Pediatía</td>
                    <td class="whitespace-nowrap signature-line px-3"></td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="text-left font-semibold px-3">3</td>
                    <td class="whitespace-nowrap max-w-xs truncate text-wrap px-3">
                        García Herrera, Fernanda Lucía
                    </td>
                    <td class="text-right">Recursos Humanos</td>
                    <td class="whitespace-nowrap signature-line px-3"></td>
                </tr>
            </tbody>
        </table>
    </x-pdf.line-items>

    <!-- Footer Notes -->
    <x-pdf.footer class="default-template-footer">
        <p class="px-6">dummy</p>
        <span class="border-t-2 my-2 border-gray-300 block w-full"></span>
        <h4 class="font-semibold px-6 mb-2">Observaciones</h4>
        <p class="px-6 break-words line-clamp-4">dummy</p>
    </x-pdf.footer>
</x-pdf.container>