<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixReactionImagePaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-reaction-image-paths';
    protected $description = 'Corrige las rutas de imágenes de reacciones en la base de datos';
    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('reaction')->update([
            'imagen_url' => DB::raw("REPLACE(imagen_url, 'storage/', '')")
        ]);

        $this->info('Rutas de imagen corregidas exitosamente.');
    }
}
