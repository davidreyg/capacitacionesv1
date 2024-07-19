<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ResetApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset App (Migraciones, Seeders, etc...)!';

    private $array_commands = array();
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->initArray();
        $bar = $this->output->createProgressBar(count($this->array_commands));
        $bar->setFormat('%current%/%max% [%bar%] %message%  <fg=green>DONE</>');
        $bar->start();

        foreach ($this->array_commands as $key => $value) {
            $bar->setMessage($value['message']);
            $value['function']();
            $bar->advance();
            // $this->newLine();
        }
        $bar->finish();
        $this->newLine();
        $this->writeInfos();
        $this->newLine();

    }

    private function writeInfos()
    {
        foreach ($this->array_commands as $key => $value) {
            $this->info($value['info']);
        }
    }

    function initArray()
    {
        array_push(
            $this->array_commands,
            [
                'message' => 'Generating APP KEY ......',
                'function' => function () {
                    Artisan::call('key:generate --force');
                },
                'info' => '1. App Key generated successfully',
            ],
            [
                'message' => 'Running optimize clear...',
                'function' => function () {
                    Artisan::call('optimize:clear -n');
                    Artisan::call('icons:clear');
                    Artisan::call('config:clear');
                    Artisan::call('cache:clear');
                    Artisan::call('clear-compiled');
                    Artisan::call('filament:clear-cached-components');
                    if ($this->mediaTableExists()) {
                        Artisan::call('media-library:clean --force');
                    }
                    Artisan::call('settings:clear-discovered');
                    Artisan::call('settings:clear-cache');

                },
                'info' => '2. App clear successfully',
            ],
            [
                'message' => 'Storage link to public..',
                'function' => function () {
                    Artisan::call('storage:unlink');
                    Artisan::call('storage:link');
                },
                'info' => '3. Storage link created',
            ],
            [
                'message' => 'Wiping DB Data............',
                'function' => function () {
                    Artisan::call('db:wipe --force');
                },
                'info' => '4. Data wiped successfully',
            ],
            [
                'message' => 'Running Migrations........',
                'function' => function () {
                    Artisan::call('migrate:refresh --seed --force');
                },
                'info' => '5. Migrations ran successfully',
            ],
            [
                'message' => 'Cache!',
                'function' => function () {
                    Artisan::call('icons:cache');
                    if (app()->isProduction()) {
                        Artisan::call('optimize');
                        Artisan::call('settings:discover');
                        Artisan::call('config:cache');
                        Artisan::call('filament:cache-components');
                    }
                },
                'info' => '7. Aplicacion cacheada exitosamente.',
            ],

        );
    }

    /**
     * Verificar si hay conexión a la base de datos.
     *
     * @return bool
     */
    function isDatabaseConnected()
    {
        try {
            // Intentar obtener la instancia PDO
            \DB::connection()->getPdo();
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public function mediaTableExists(): bool
    {
        // Verificar la conexión a la base de datos
        if (!$this->isDatabaseConnected()) {
            // Verificar si la tabla 'media' existe
            return false;
        }
        if (\Schema::hasTable('media')) {
            return true;
        }
        return false;
    }
}

