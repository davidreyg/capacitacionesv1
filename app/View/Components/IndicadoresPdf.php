<?php

namespace App\View\Components;

use App\DTO\IndicadorFiltroData;
use App\Enums\Notificacion\TipoNotificacion;
use App\Enums\RegistroAccidente\GravedadEnum;
use App\Models\Periodo;
use App\Settings\GeneralSettings;
use App\Settings\ReportSettings;
use Carbon\CarbonPeriod;
use Closure;
use DateTime;
use DB;
use Filament\Panel\Concerns\HasFont;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class IndicadoresPdf extends Component
{
    use HasFont;
    public ReportSettings $reportSettings;
    public GeneralSettings $generalSettings;
    public array $datos;
    public string $fontFam;
    public Htmlable $fontHtml;
    public Collection $periodos;
    public array $fechasEnRango;
    public DateTime $startDate;
    public DateTime $endDate;

    public function __construct(IndicadorFiltroData $datos, ReportSettings $reportSettings, GeneralSettings $generalSettings)
    {
        // dd($datos->get('fecha_inicio')->);
        $this->reportSettings = $reportSettings;
        $this->fontFam = $this->reportSettings->font->getLabel();
        $this->fontHtml = $this->font($this->reportSettings->font->getLabel())->getFontHtml();
        $this->periodos = Periodo::get();
        $this->generalSettings = $generalSettings;
        $this->startDate = $datos->fechaInicio;
        $this->endDate = $datos->fechaFin;

        // Crear un periodo mensual
        $meses = CarbonPeriod::create($this->startDate, '1 month', $this->endDate);

        // Filtrar los periodos que estén dentro del rango
        $this->fechasEnRango = $this->periodos->filter(function ($periodo) use ($meses) {
            return in_array($periodo->fecha->format('Y-m'), array_map(
                fn($fecha) => $fecha->format('Y-m'),
                iterator_to_array($meses)
            ));
        })->map(function ($periodo) {
            return $periodo->fecha->format('Y-m');
        })->unique()->values()->toArray();
        $this->calcularData();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.indicadores-pdf');
    }

    function calcularData(): void
    {
        $accidentesLeves = DB::table('notificacions')
            ->join('anexo_unos', 'notificacions.id', '=', 'anexo_unos.notificacion_id')
            ->join('anexo_uno_consecuencia', 'anexo_unos.id', '=', 'anexo_uno_consecuencia.anexo_uno_id')
            ->join('consecuencias', 'anexo_uno_consecuencia.consecuencia_id', '=', 'consecuencias.id')
            ->where('consecuencias.nombre', GravedadEnum::ACCIDENTE_LEVE->name)
            ->whereBetween('notificacions.fecha', [$this->startDate, $this->endDate])
            ->selectRaw('DATE_FORMAT(notificacions.fecha, "%Y-%m") as yearMonth, COUNT(consecuencias.id) as total')
            ->groupBy('yearMonth')
            ->orderBy('yearMonth')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->yearMonth => $item->total];
            })
            ->toArray();
        // Accidentes Mortales
        $accidentesMortales = DB::table('notificacions')
            ->join('anexo_unos', 'notificacions.id', '=', 'anexo_unos.notificacion_id')
            ->join('anexo_uno_consecuencia', 'anexo_unos.id', '=', 'anexo_uno_consecuencia.anexo_uno_id')
            ->join('consecuencias', 'anexo_uno_consecuencia.consecuencia_id', '=', 'consecuencias.id')
            ->where('consecuencias.nombre', GravedadEnum::ACCIDENTE_MORTAL->name)
            ->whereBetween('notificacions.fecha', [$this->startDate, $this->endDate])
            ->selectRaw('DATE_FORMAT(notificacions.fecha, "%Y-%m") as yearMonth, COUNT(consecuencias.id) as total')
            ->groupBy('yearMonth')
            ->orderBy('yearMonth')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->yearMonth => $item->total];
            })
            ->toArray();
        $accidentesIncapacitantes = DB::table('notificacions')
            ->join('anexo_unos', 'notificacions.id', '=', 'anexo_unos.notificacion_id')
            ->join('anexo_uno_consecuencia', 'anexo_unos.id', '=', 'anexo_uno_consecuencia.anexo_uno_id')
            ->join('consecuencias', 'anexo_uno_consecuencia.consecuencia_id', '=', 'consecuencias.id')
            ->where('consecuencias.grupo', GravedadEnum::ACCIDENTE_INCAPACITANTE->name)
            ->whereBetween('notificacions.fecha', [$this->startDate, $this->endDate])
            ->selectRaw('DATE_FORMAT(notificacions.fecha, "%Y-%m") as yearMonth, COUNT(consecuencias.id) as total')
            ->groupBy('yearMonth')
            ->orderBy('yearMonth')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->yearMonth => $item->total];
            })
            ->toArray();

        $diasDescanso = DB::table('notificacions')
            ->join('registro_accidentes', 'notificacions.id', '=', 'registro_accidentes.notificacion_id')
            ->whereBetween('notificacions.fecha', [$this->startDate, $this->endDate])
            ->selectRaw('DATE_FORMAT(notificacions.fecha, "%Y-%m") as yearMonth, SUM(registro_accidentes.dias_descanso) as total')
            ->groupBy('yearMonth')
            ->orderBy('yearMonth')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->yearMonth => $item->total];
            });

        $enfermedadesTrabajo = DB::table('notificacions')
            ->join('anexo_unos', 'notificacions.id', '=', 'anexo_unos.notificacion_id')
            ->whereNotNull('anexo_unos.anexo_uno_enfermedades_trabajo_id')
            ->whereBetween('notificacions.fecha', [$this->startDate, $this->endDate])
            ->selectRaw('DATE_FORMAT(notificacions.fecha, "%Y-%m") as yearMonth, COUNT(anexo_unos.id) as total')
            ->groupBy('yearMonth')
            ->orderBy('yearMonth')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->yearMonth => $item->total];
            });

        $agentesCausantes = DB::table('notificacions')
            ->join('anexo_unos', 'notificacions.id', '=', 'anexo_unos.notificacion_id')
            ->whereNotNull('anexo_unos.anexo_uno_agente_causante_id')
            ->whereBetween('notificacions.fecha', [$this->startDate, $this->endDate])
            ->selectRaw('DATE_FORMAT(notificacions.fecha, "%Y-%m") as yearMonth, COUNT(anexo_unos.id) as total')
            ->groupBy('yearMonth')
            ->orderBy('yearMonth')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->yearMonth => $item->total];
            });

        $incidentes = DB::table('notificacions')
            ->where('tipo_notificacion_verificado', TipoNotificacion::INCIDENTE->value)
            ->whereBetween('fecha', [$this->startDate, $this->endDate])
            ->selectRaw('DATE_FORMAT(notificacions.fecha, "%Y-%m") as yearMonth, COUNT(id) as total')
            ->groupBy('yearMonth')
            ->orderBy('yearMonth')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->yearMonth => $item->total];
            })
            ->toArray();

        $accidentes = DB::table('notificacions')
            ->where('tipo_notificacion_verificado', TipoNotificacion::ACCIDENTE->value)
            ->whereBetween('fecha', [$this->startDate, $this->endDate])
            ->selectRaw('DATE_FORMAT(notificacions.fecha, "%Y-%m") as yearMonth, COUNT(id) as total')
            ->groupBy('yearMonth')
            ->orderBy('yearMonth')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->yearMonth => $item->total];
            })
            ->toArray();

        // Conteo de establecimientos
        $establecimientos = DB::table('notificacions')
            ->join('empleados', 'notificacions.empleado_id', '=', 'empleados.id')
            ->join('establecimientos', 'empleados.establecimiento_id', '=', 'establecimientos.id')
            ->whereBetween('notificacions.fecha', [$this->startDate, $this->endDate])
            ->selectRaw('DATE_FORMAT(notificacions.fecha, "%Y-%m") as yearMonth, COUNT(DISTINCT establecimientos.id) as total')
            ->groupBy('yearMonth')
            ->orderBy('yearMonth')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->yearMonth => $item->total];
            });
        $unidadesOrganicas = DB::table('notificacions')
            ->join('empleados', 'notificacions.empleado_id', '=', 'empleados.id')
            ->join('unidad_organicas', 'empleados.unidad_organica_id', '=', 'unidad_organicas.id')
            ->whereBetween('notificacions.fecha', [$this->startDate, $this->endDate])
            ->selectRaw('DATE_FORMAT(notificacions.fecha, "%Y-%m") as yearMonth, COUNT(DISTINCT unidad_organicas.id) as total')
            ->groupBy('yearMonth')
            ->orderBy('yearMonth')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->yearMonth => $item->total];
            });

        // return $accidentesIncapacitantes;

        // return $accidentesMortales;
        $this->datos = collect($this->fechasEnRango)->mapWithKeys(
            function ($month) use ($accidentesIncapacitantes, $accidentesMortales, $accidentesLeves, $diasDescanso, $enfermedadesTrabajo, $agentesCausantes, $incidentes, $accidentes, $establecimientos, $unidadesOrganicas) {

                $incapacitantes = intval($accidentesIncapacitantes[$month] ?? 0);
                $dias_perdidos = intval($diasDescanso[$month] ?? 0);
                $enfermedad_ocupacional = intval($enfermedadesTrabajo[$month] ?? 0);
                $expuestos_agente = intval($agentesCausantes[$month] ?? 0);

                $HORAS_TRABAJADAS = intval($this->periodos->first(function ($periodo) use ($month) {
                    return $periodo->fecha->format('Y-m') === $month;
                })->horas_trabajadas ?? 0);
                $INDICE_FRECUENCIA = round(($incapacitantes * 1000000) / $HORAS_TRABAJADAS, 2);
                $INDICE_GRAVEDAD = round(($dias_perdidos * 1000000) / $HORAS_TRABAJADAS, 2);
                $INDICE_ACCIDENTABILIDAD = round(sqrt($INDICE_GRAVEDAD * $INDICE_FRECUENCIA), 2);
                $TASA_INCIDENCIA = $expuestos_agente !== 0
                    ? round(($enfermedad_ocupacional / $expuestos_agente) * 100, 2)
                    : 0; // Valor por defecto si el divisor es 0
                return [
                    $month => [
                        'incapacitantes' => $incapacitantes,
                        'mortales' => $accidentesMortales[$month] ?? 0,
                        'leves' => $accidentesLeves[$month] ?? 0,
                        'dias_perdidos' => $dias_perdidos,
                        'enfermedad_ocupacional' => $enfermedad_ocupacional,
                        'expuestos_agente' => $expuestos_agente,
                        'incidentes' => $incidentes[$month] ?? 0,
                        'accidentes' => $accidentes[$month] ?? 0,
                        'establecimientos' => $establecimientos[$month] ?? 0,
                        'unidades_organicas' => $unidadesOrganicas[$month] ?? 0,
                        'HORAS_TRABAJADAS' => $HORAS_TRABAJADAS,
                        'indice_frecuencia' => $INDICE_FRECUENCIA,
                        'indice_gravedad' => $INDICE_GRAVEDAD,
                        'indice_accidentabilidad' => $INDICE_ACCIDENTABILIDAD,
                        'tasa_incidencia' => $TASA_INCIDENCIA,
                    ]
                ];
            }
        )->toArray();

    }
}
