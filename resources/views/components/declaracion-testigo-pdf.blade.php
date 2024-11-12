<div>
    <table class="min-w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="px-2 py-1 border border-gray-300 bg-blue-400 text-center" colspan="4">DATOS DE LA PERSONA
                    DECLARANTE
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Marcar (X)</td>
                <td class="px-2 py-1 border border-gray-300" colspan="3">
                    <div class="flex items-center space-x-4">
                        <div>
                            Persona declarante:
                        </div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="tipo_declarante[]"
                                value="{{ \App\Enums\Declaracion\TipoDeclaranteEnum::AFECTADO->value }}"
                                class="form-checkbox" @if ($declaracion->tipo_declarante === \App\Enums\Declaracion\TipoDeclaranteEnum::AFECTADO) checked @endif>
                            <span class="ml-2">Afectado</span>
                        </label>

                        <label class="inline-flex items-center">
                            <input type="checkbox" name="tipo_declarante[]"
                                value="{{ \App\Enums\Declaracion\TipoDeclaranteEnum::TESTIGO->value }}"
                                class="form-checkbox" @if ($declaracion->tipo_declarante === \App\Enums\Declaracion\TipoDeclaranteEnum::TESTIGO) checked @endif>
                            <span class="ml-2">Testigo</span>
                        </label>

                        <label class="inline-flex items-center">
                            <input type="checkbox" name="tipo_declarante[]"
                                value="{{ \App\Enums\Declaracion\TipoDeclaranteEnum::OTRO->value }}"
                                class="form-checkbo" @if ($declaracion->tipo_declarante === \App\Enums\Declaracion\TipoDeclaranteEnum::OTRO) checked @endif>
                            <span class="ml-2">Otro</span>
                        </label>
                    </div>
                </td>
            </tr>
            <tr class="border-b">
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Empresa</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->empleado->establecimiento->nombre }}
                </td>
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Antigüedad en el empleo:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->empleado->antiguedad_puesto }}
                </td>
            </tr>
            <tr class="border-b">
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Nombre:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->empleado->nombre_completo }}
                </td>
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Tiempo de experiencia:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->empleado->tiempo_experiencia }}
                </td>
            </tr>
            <tr class="border-b">
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Área:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->empleado->unidadOrganica->nombre }}
                </td>
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Grado de Instrucción:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->empleado->grado_instruccion }}
                </td>
            </tr>
            <tr class="border-b">
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Cargo:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->empleado->cargo->nombre }}
                </td>
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Firma:</td>
                <td class="px-2 py-1 border border-gray-300">
                    ______________
                </td>
            </tr>

        </tbody>
    </table>
    <table class="min-w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="px-2 py-1 border border-gray-300 bg-blue-400 text-center" colspan="4">
                    DATOS DEL INCIDENTE O ACCIDENTE LABORAL
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Fecha de ocurrencia:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->fecha_ocurrencia }}
                </td>
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Lugar de ocurrencia:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->lugar_ocurrencia }}
                </td>
            </tr>
            <tr class="border-b">
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Hora de ocurrencia:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->hora_ocurrencia }}
                </td>
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">¿Evento fue reportado al jefe inmediato?</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->reportado_jefe_inmediato ? 'SI' : 'NO' }}
                </td>
            </tr>

        </tbody>
    </table>

    <table class="min-w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="px-2 py-1 border border-gray-300 bg-blue-400 text-center">
                    DECLARACION
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($declaracion->preguntas as $pregunta)
                <tr class="border-b">
                    <td class="px-2 py-1 border border-gray-300 bg-gray-200 font-bold">
                        {{ $pregunta->nombre }}
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="px-2 py-1 border border-gray-300 ">
                        {{ $pregunta->pivot->respuesta }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="min-w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="px-2 py-1 border border-gray-300 bg-blue-400 text-center" colspan="4">
                    DATOS DE LA DECLARACIÓN
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Fecha:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->created_at->format('m-d-Y') }}
                </td>
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Hora:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->created_at->format('H:i') }}
                </td>
            </tr>
            <tr class="border-b">
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Responsable de la toma de declaración:</td>
                <td class="px-2 py-1 border border-gray-300">
                    {{ $declaracion->user->empleado->nombre_completo }}
                </td>
                <td class="px-2 py-1 border border-gray-300 bg-gray-200">Firma:</td>
                <td class="px-2 py-1 border border-gray-300">
                    ______________
                </td>
            </tr>

        </tbody>
    </table>
</div>
