<style>
    .contenido {
        font-size: 0.65rem
            /* 12px */
        ;
    }
</style>
<div class="contenido">
    {{-- titulo --}}
    <div class="text-center mb-4">
        <p class="text-lg font-semibold">ANEXO Nº 01</p>
        <p class="text-base font-semibold">Ficha de Registro y Notificación de Accidente de Trabajo y Enfermedad
            Relacionada al Trabajo</p>
        <p class="text-sm font-light">REGLAMENTO DE SEGURIDAD Y SALUD EN EL TRABAJO</p>
        <p class="text-sm font-light">(DS Nº 009 – 2005 – TR)</p>
    </div>

    <div class="flex items-end space-x-2">
        <span class="text-sm">Año</span>
        <div class="border-b border-black w-12"></div>
        <span class="text-sm">Mes</span>
        <div class="border-b border-black w-12"></div>
    </div>


    <p class=" mb-2 mt-4">MARCAR CON UN [X] EN LO QUE CORRESPONDA (Para ser llenado por el Centro Médico
        Asistencial
        y/o Servicio de Salud Ocupacional)</p>

    <div class="flex items-center mb-4">
        <span class="">AVISO DE ACCIDENTE DE TRABAJO</span>
        <div class="w-6 h-6 border border-black ml-2 text-center">
            @if ($anexoUno->tipo === \App\Enums\AnexoUno\TipoAnexoUno::ACCIDENTE)
                X
            @endif
        </div>
        <span class=" ml-6">AVISO DE ENFERMEDADES RELACIONADAS AL TRABAJO</span>
        <div class="w-6 h-6 border border-black ml-2 text-center">

            @if ($anexoUno->tipo === \App\Enums\AnexoUno\TipoAnexoUno::ENFERMEDADES)
                X
            @endif
        </div>
    </div>

    <div class="flex items-center">
        <p class="mb-1">FECHA DE PRESENTACIÓN</p>
        <div class="ml-4">
            <table>
                <tbody>
                    <tr class="border-b">
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ \Carbon\Carbon::parse($anexoUno->fecha_presentacion)->day }}</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ \Carbon\Carbon::parse($anexoUno->fecha_presentacion)->month }}</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">
                            {{ \Carbon\Carbon::parse($anexoUno->fecha_presentacion)->year }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-2 py-1 border border-gray-30 text-center">DÍA</td>
                        <td class="px-2 py-1 border border-gray-30 text-center">MES</td>
                        <td class="px-2 py-1 border border-gray-30 text-center">AÑO</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- PASO 1 DATOS DEL EMPLEADOR --}}
    <div class="w-full mt-4">
        <span class="font-bold border-b-2 border-black mt-10">
            I. DATOS DEL EMPLEADOR
        </span>
    </div>
    <div class="grid grid-flow-row gap-y-4 mt-4">
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <p>2. RAZÓN SOCIAL</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoEmpleador->nombre }}
                </div>
            </div>
            <div>
                <p>3. RUC</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoEmpleador->ruc }}
                </div>
            </div>
        </div>
        <div>
            <p>4. DOMICILIO PRINCIPAL</p>
            <div class="h-6 border border-black ml-2 text-center">
                {{ $anexoUno->establecimientoEmpleador->direccion }}
            </div>
        </div>
        <div class="grid grid-cols-4 gap-x-4">
            <div>
                <p>5. DEPARTAMENTO</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoEmpleador->distrito->provincia->departamento->nombre }}
                </div>
            </div>
            <div>
                <p>6. PROVINCIA</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoEmpleador->distrito->provincia->nombre }}
                </div>
            </div>
            <div>
                <p>7. DISTRITO</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoEmpleador->distrito->nombre }}
                </div>
            </div>
            <div>
                <p>UBIGEO (No llenar)</p>
                <div class="h-6 border border-black ml-2 text-center">
                </div>
            </div>
        </div>
        <div class="flex flex-row space-x-3">
            <div class="flex-auto">
                <p>8.ACTIVIDAD ECONOMICA (DETALLAR)</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoEmpleador->anexoUnoActividadEconomica->descripcion }}
                </div>
            </div>
            <div class="flex-1">
                <p>CIIU (TABLA N° 2)</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoEmpleador->anexoUnoActividadEconomica->codigo }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <p>9. N° DE TRABAJADORES</p>
                <div class="flex items-center space-x-3">
                    <div>
                        M <span class="h-5 border border-black ml-2 text-center p-0.5">
                            {{ count($anexoUno->establecimientoEmpleador->empleados->where('sexo', 'M')) }}
                        </span>
                    </div>
                    <div>
                        F <span class="h-5 border border-black ml-2 text-center p-0.5">
                            {{ count($anexoUno->establecimientoEmpleador->empleados->where('sexo', 'F')) }}
                        </span>
                    </div>
                </div>

            </div>
            <div>
                <p>10. N° DE TELEFONO</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoEmpleador->telefono }}
                </div>
            </div>
        </div>
    </div>

    {{-- PASO 2 DATOS DE LA EMPRESA USUARIA DONDE EJECUTA LAS LABORES  --}}
    <div class="w-full mt-6">
        <span class="font-bold border-b-2 border-black mt-10">
            II. DATOS DE LA EMPRESA USUARIA DONDE EJECUTA LAS LABORES
        </span>
    </div>
    <div class="grid grid-flow-row gap-y-4 mt-4">
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <p>11. RAZÓN SOCIAL</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoLaboral->nombre }}
                </div>
            </div>
            <div>
                <p>12. RUC</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoLaboral->ruc }}
                </div>
            </div>
        </div>
        <div>
            <p>13. DOMICILIO PRINCIPAL</p>
            <div class="h-6 border border-black ml-2 text-center">
                {{ $anexoUno->establecimientoLaboral->direccion }}
            </div>
        </div>
        <div class="grid grid-cols-4 gap-x-4">
            <div>
                <p>14. DEPARTAMENTO</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoLaboral->distrito->provincia->departamento->nombre }}
                </div>
            </div>
            <div>
                <p>15. PROVINCIA</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoLaboral->distrito->provincia->nombre }}
                </div>
            </div>
            <div>
                <p>16. DISTRITO</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoLaboral->distrito->nombre }}
                </div>
            </div>
            <div>
                <p>UBIGEO (No llenar)</p>
                <div class="h-6 border border-black ml-2 text-center">
                </div>
            </div>
        </div>
        <div class="flex flex-row space-x-3">
            <div class="flex-auto">
                <p>17. ACTIVIDAD ECONOMICA (DETALLAR)</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoLaboral->anexoUnoActividadEconomica->descripcion }}
                </div>
            </div>
            <div class="flex-1">
                <p>CIIU (TABLA N° 2)</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoLaboral->anexoUnoActividadEconomica->codigo }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <p>18. N° DE TRABAJADORES</p>
                <div class="flex items-center space-x-3">
                    <div>
                        M <span class="h-5 border border-black ml-2 text-center p-0.5">
                            {{ count($anexoUno->establecimientoLaboral->empleados->where('sexo', 'M')) }}
                        </span>
                    </div>
                    <div>
                        F <span class="h-5 border border-black ml-2 text-center p-0.5">
                            {{ count($anexoUno->establecimientoLaboral->empleados->where('sexo', 'F')) }}
                        </span>
                    </div>
                </div>

            </div>
            <div>
                <p>19.N° DE TELEFONO</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->establecimientoLaboral->telefono }}
                </div>
            </div>
        </div>
    </div>

    {{-- PASO 3. III.- DATOS DEL TRABAJADOR  --}}
    <div class="w-full mt-6">
        <span class="font-bold border-b-2 border-black mt-10">
            III.- DATOS DEL TRABAJADOR
        </span>
    </div>

    <div class="grid grid-flow-row gap-y-4 mt-4">
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <p>20. APELLIDOS Y NOMBRES</p>
                <div class="h-6 border border-black text-center">
                    {{ $anexoUno->empleado->nombre_completo }}
                </div>
            </div>
            <div>
                <p>21. DNI / CE</p>
                <div class="h-6 border border-black text-center">
                    {{ $anexoUno->empleado->numero_documento }}
                </div>
            </div>
        </div>
        <div>
            <p>22. DOMICILIO</p>
            <div class="h-6 border border-black text-center">
                {{ $anexoUno->empleado->direccion }}
            </div>
        </div>
        <div class="grid grid-cols-4 gap-x-4">
            <div>
                <p>23. DEPARTAMENTO</p>
                <div class="h-6 border border-black  text-center">
                    {{ $anexoUno->empleado->distrito->provincia->departamento->nombre }}
                </div>
            </div>
            <div>
                <p>24. PROVINCIA</p>
                <div class="h-6 border border-black  text-center">
                    {{ $anexoUno->empleado->distrito->provincia->nombre }}
                </div>
            </div>
            <div>
                <p>25. DISTRITO</p>
                <div class="h-6 border border-black  text-center">
                    {{ $anexoUno->empleado->distrito->nombre }}
                </div>
            </div>
            <div>
                <p>UBIGEO (No llenar)</p>
                <div class="h-6 border border-black  text-center">
                </div>
            </div>
        </div>
        <div class="flex flex-row space-x-3">
            <div class="flex-auto">
                <p>26. CATEGORIA OCUPACIONAL</p>
                <div class="h-6 border border-black  text-center">
                    {{ $anexoUno->empleado->anexoUnoCategoriaTrabajador->codigo }} -
                    {{ $anexoUno->empleado->anexoUnoCategoriaTrabajador->descripcion }}
                </div>
            </div>
            <div>
                <p>27. ASEGURADO</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->empleado->asegurado ? 'SI' : 'NO' }}
                </div>
            </div>
            <div>
                <p>28. ESSALUD</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->empleado->essalud }}
                </div>
            </div>
            <div>
                <p>29. EPS</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ $anexoUno->empleado->eps }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <p>30. EDAD</p>
                <div class="h-6 border border-black ml-2 text-center">
                    {{ \Carbon\Carbon::parse($anexoUno->empleado->fecha_nacimiento)->age }}
                </div>
            </div>
            <div>
                <p>31. GÉNERO</p>
                <div class="flex items-center space-x-3">
                    <div class="flex flex-row">
                        M <span class="w-6 h-6 border border-black ml-2 text-center p-0.5">
                            @if ($anexoUno->empleado->sexo === 'M')
                                X
                            @endif
                        </span>
                    </div>
                    <div class="flex flex-row">
                        F <div class="w-6 h-6 border border-black ml-2 text-center p-0.5">
                            @if ($anexoUno->empleado->sexo === 'F')
                                X
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PASO 4. IV.- DATOS DEL ACCIDENTE DE TRABAJO --}}
    <div class="w-full mt-6">
        <span class="font-bold border-b-2 border-black mt-10">
            IV.- DATOS DEL ACCIDENTE DE TRABAJO</span>
    </div>
    <div class="grid grid-flow-row gap-y-4 mt-4">
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <p>32. FECHA DE ACCIDENTE</p>
                <div class="h-6 border border-black text-center">
                    {{ $anexoUno->fecha_hora_accidente->format('m/d/Y') }}
                </div>
            </div>
            <div>
                <p>33. HORA DE ACCIDENTE</p>
                <div class="h-6 border border-black text-center">
                    {{ $anexoUno->fecha_hora_accidente->format('H:i') }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <p>34. FORMA DE ACCIDENTE (TABLA Nº 3)</p>
                <div class="h-6 border border-black text-center">
                    {{ $anexoUno->anexoUnoFormaAccidente->codigo }} -
                    {{ $anexoUno->anexoUnoFormaAccidente->descripcion }}
                </div>
            </div>
            <div>
                <p>35. AGENTE CAUSANTE (TABLA Nº 4)</p>
                <div class="h-6 border border-black text-center">
                    {{ $anexoUno->anexoUnoAgenteCausante->codigo }} -
                    {{ $anexoUno->anexoUnoAgenteCausante->descripcion }}
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mt-6">
        <span class="font-bold border-b-2 border-black mt-6">
            CERTIFICACIÓN MEDICA</span>
    </div>
    <div class="grid grid-flow-row gap-y-4 mt-4">
        <div>
            <p>36.CENTRO MÉDICO ASISTENCIAL Y/O SERVICIO DE SALUD OCUPACIONAL:</p>
            <div class="h-6 border border-black text-center">
                {{ $anexoUno->accidente_centro_medico_nombre }}
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-4 items-center">
            <div class="flex flex-row space-x-2">
                <div class="flex-auto">37. RUC</div>
                <div class="flex-grow h-6 border border-black text-center">
                    {{ $anexoUno->accidente_centro_medico_nombre }}
                </div>
            </div>
            <div class="flex flex-row space-x-2">
                <div class="flex-auto">38. FECHA DE INGRESO</div>
                <div class="flex-grow h-6 border border-black text-center">
                    {{ $anexoUno->accidente_fecha_ingreso->format('d/m/Y') }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <p>39. PARTE DEL CUERPO AFECTADO (TABLA Nº 05)</p>
                <div class="h-6 border border-black text-center">
                    {{ $anexoUno->anexoUnoParteAfectada->codigo }} -
                    {{ $anexoUno->anexoUnoParteAfectada->descripcion }}
                </div>
            </div>
            <div>
                <p>40. NATURALEZA DE LA LESION (TABLA Nº 06)</p>
                <div class="h-6 border border-black text-center">
                    {{ $anexoUno->anexoUnoNaturalezaLesion->codigo }} -
                    {{ $anexoUno->anexoUnoNaturalezaLesion->descripcion }}
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mt-6">
        <span class="font-bold border-b-2 border-black mt-6">
            CONSECUENCIAS DEL ACCIDENTE </span><span>(Marcar con una X en lo que
            corresponda)</span>
    </div>
    <div class="grid grid-flow-row gap-y-4 mt-4">
        @php
            $contadorConsecuencia = 41;
        @endphp
        @foreach (App\Models\AnexoUno\Consecuencia::orderBy('orden')->get()->groupBy('grupo') as $key => $grupo)
            <span class="">{{ $key }}</span>
            @if (!$key)
                <div class="flex flex-col space-y-1">
                    @foreach ($grupo as $key => $consecuencia)
                        <div class="flex flex-row space-x-2">
                            <div class="">{{ $contadorConsecuencia }}. {{ $consecuencia->nombre }}</div>
                            @php
                                $contadorConsecuencia++;
                                $cons = $anexoUno->consecuencias->find($consecuencia->id);
                            @endphp
                            <div class="w-6 h-6 border border-black text-center">
                                {{ $cons ? 'X' : '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-row space-x-2">
                    @foreach ($grupo as $key => $consecuencia)
                        <div class="flex flex-row space-x-2">
                            <div class="">43.{{ $key + 1 }}. {{ $consecuencia->nombre }}</div>
                            @php
                                $contadorConsecuencia++;
                                $cons = $anexoUno->consecuencias->find($consecuencia->id);
                            @endphp
                            <div class="w-6 h-6 border border-black text-center">
                                {{ $cons ? 'X' : '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
        <div class="flex flex-row space-x-2 items-center">
            <div class="">44. APELLIDOS Y NOMBRES DEL MÉDICO</div>
            <div class="flex-auto h-6 border border-black text-center">
                {{ $anexoUno->accidente_medico_nombre }}
            </div>
        </div>
        <div class="flex flex-row space-x-2 items-center">
            <div class="">45. N° DE COLEGIATURA</div>
            <div class="flex-auto h-6 border border-black text-center">
                {{ $anexoUno->accidente_medico_numero_colegiatura }}
            </div>
        </div>
    </div>

    {{-- PASO 5. V.- DATOS DE LA ENFERMEDAD RELACIONADA AL TRABAJO --}}
    <div class="w-full mt-6">
        <span class="font-bold border-b-2 border-black mt-10">
            V.- DATOS DE LA ENFERMEDAD RELACIONADA AL TRABAJO</span>
    </div>
    <div class="grid grid-flow-row gap-y-4 mt-4">
        <div>
            <p>46. NOMBRE Y NATURALEZA DE LA ENFERMEDAD RELACIONADA AL TRABAJO: (TABLA N° 07)</p>
            <div class="h-6 border border-black text-center">
                {{ $anexoUno->anexoUnoEnfermedadesTrabajo->codigo }} -
                {{ $anexoUno->anexoUnoEnfermedadesTrabajo->descripcion }}
            </div>
        </div>
    </div>
    <div class="w-full mt-6">
        <span class="font-bold border-b-2 border-black mt-6">
            FACTOR DE RIESGO CAUSANTE </span><span>(Marcar con una X en lo que
            corresponda)</span>
    </div>
    <div class="grid grid-flow-col gap-4 mt-4">
        @php
            $contadorRiesgo = 47;
        @endphp
        @foreach (App\Models\AnexoUno\Riesgo::get() as $riesgo)
            <div class="flex flex-row space-x-2">
                <div class="flex-auto">{{ $contadorRiesgo }}. {{ $riesgo->nombre }}</div>
                @php
                    $contadorRiesgo++;
                    $riesgoEncontrado = $anexoUno->riesgos->find($riesgo->id);
                @endphp
                <div class="w-6 h-6 border border-black text-center">
                    {{ $riesgoEncontrado ? 'X' : '' }}
                </div>
            </div>
        @endforeach
    </div>
    <div class="w-full mt-6">
        <span class="font-bold border-b-2 border-black mt-6">
            CERTIFICACIÓN MEDICA </span>
    </div>
    <div class="grid grid-cols-2 gap-4 items-center">
        <div>
            <p>52.CENTRO MÉDICO ASISTENCIAL Y/O SERVICIO DE SALUD OCUPACIONAL:</p>
            <div class="h-6 border border-black text-center">
                {{ $anexoUno->enfermedad_centro_medico_nombre }}
            </div>
        </div>
        <div>
            <p class="flex-auto">53. RUC</p>
            <div class="flex-grow h-6 border border-black text-center">
                {{ $anexoUno->enfermedad_centro_medico_ruc }}
            </div>
        </div>
        <div>
            <div class="flex-auto">54. FECHA DE INGRESO</div>
            <div class="flex-grow h-6 border border-black text-center">
                {{ $anexoUno->enfermedad_fecha_ingreso->format('d/m/Y') }}
            </div>
        </div>
        <div>
            <div class="flex-auto">55. ENFERMEDAD RELACIONADA AL TRABAJO</div>
            <div class="flex-grow h-auto border border-black text-center">
                {{ $anexoUno->anexoUnoEnfermedadesTrabajo->codigo }} -
                {{ $anexoUno->anexoUnoEnfermedadesTrabajo->descripcion }}
            </div>
        </div>

    </div>
    <div class="grid grid-flow-row gap-y-4 mt-4">

        <div class="flex flex-row space-x-2 items-center">
            <div class="">56. APELLIDOS Y NOMBRES DEL MÉDICO</div>
            <div class="flex-auto h-6 border border-black text-center">
                {{ $anexoUno->enfermedad_medico_nombre }}
            </div>
        </div>
        <div class="flex flex-row space-x-2 items-center">
            <div class="">57. N° DE COLEGIATURA</div>
            <div class="flex-auto h-6 border border-black text-center">
                {{ $anexoUno->enfermedad_medico_numero_colegiatura }}
            </div>
        </div>
    </div>
</div>
