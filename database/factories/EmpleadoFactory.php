<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    // Propiedades estáticas para almacenar los IDs
    protected static $establecimientoIds = null;
    protected static $unidadOrganicaIds = null;
    protected static $cargoIds = null;
    protected static $tipoPlanillaIds = null;
    protected static $condicionIds = null;
    protected static $desplazamientoIds = null;
    protected static $regimenLaboralIds = null;
    protected static $funcionIds = null;

    /**
     * Método para inicializar los IDs.
     */
    protected static function initializeIds()
    {
        if (is_null(self::$establecimientoIds)) {
            self::$establecimientoIds = \DB::table('establecimientos')->pluck('id')->toArray();
            self::$unidadOrganicaIds = \DB::table('unidad_organicas')->pluck('id')->toArray();
            self::$cargoIds = \DB::table('cargos')->pluck('id')->toArray();
            self::$tipoPlanillaIds = \DB::table('tipo_planillas')->pluck('id')->toArray();
            self::$condicionIds = \DB::table('condicions')->pluck('id')->toArray();
            self::$desplazamientoIds = \DB::table('desplazamientos')->pluck('id')->toArray();
            self::$regimenLaboralIds = \DB::table('regimen_laborals')->pluck('id')->toArray();
            self::$funcionIds = \DB::table('funcions')->pluck('id')->toArray();
        }
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Inicializar IDs si no han sido cargados
        self::initializeIds();

        return [
            'numero_documento' => fake()->unique()->randomNumber(8),
            'nombres' => fake()->firstName . ' ' . fake()->firstName,
            'apellido_paterno' => fake()->lastName,
            'apellido_materno' => fake()->lastName,
            'fecha_nacimiento' => fake()->date(),
            'fecha_alta' => fake()->date(),
            'sexo' => fake()->randomElement(['M', 'F']),
            'plaza' => fake()->numberBetween(1, 10),
            'viene_de' => fake()->company,
            'email' => fake()->unique()->safeEmail,
            'telefono' => fake()->phoneNumber,
            'establecimiento_id' => fake()->randomElement(self::$establecimientoIds),
            'unidad_organica_id' => fake()->randomElement(self::$unidadOrganicaIds),
            'cargo_id' => fake()->randomElement(self::$cargoIds),
            'tipo_planilla_id' => fake()->randomElement(self::$tipoPlanillaIds),
            'condicion_id' => fake()->randomElement(self::$condicionIds),
            'desplazamiento_id' => fake()->randomElement(self::$desplazamientoIds),
            'regimen_laboral_id' => fake()->randomElement(self::$regimenLaboralIds),
            'funcion_id' => fake()->randomElement(self::$funcionIds),
        ];
    }
}
