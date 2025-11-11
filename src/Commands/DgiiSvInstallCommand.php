<?php

namespace DazzaDev\LaravelDgiiSv\Commands;

use DazzaDev\LaravelDgiiSv\Models\DgiiListing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DgiiSvInstallCommand extends Command
{
    protected $signature = 'dgii-sv:install';

    protected $description = 'Llena las tablas con la información del paquete DGII SV';

    public function handle()
    {
        $this->info('Iniciando instalación de DGII SV ...');

        $jsonPath = base_path('vendor/dazza-dev/dgii-json-generator/src/Data');

        if (! File::exists($jsonPath)) {
            $this->error("No se encontró la carpeta de datos en: $jsonPath");

            return;
        }

        // Get all files in the JSON folder
        $files = File::files($jsonPath);

        // Iterate through all files in the JSON folder
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $tableName = str_replace('.json', '', $filename);

            // Read and decode JSON
            $data = json_decode(File::get($file->getPathname()), true);

            if (! $data || ! is_array($data)) {
                $this->warn("El archivo {$filename} no tiene un formato JSON válido.");

                continue;
            }

            // Insert data
            $formattedData = array_map(function ($item) use ($tableName) {
                return [
                    'name' => $item['name'],
                    'code' => $item['code'],
                    'description' => $item['description'] ?? null,
                    'type' => $tableName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $data);

            DgiiListing::insertOrIgnore($formattedData);
            $this->info("Datos de {$tableName} insertados correctamente.");
        }

        $this->info('Proceso finalizado con éxito.');
    }
}
