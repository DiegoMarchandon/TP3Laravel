<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $names = ['Diseños', 'Información', 'Mis Tatuajes', 'Ayuda'];

        foreach ($names as $name) {
            DB::table('categories')->updateOrInsert(['name' => $name]);
        }
    }

    public function down(): void
    {
        DB::table('categories')
            ->whereIn('name', ['Diseños', 'Información', 'Mis Tatuajes', 'Ayuda'])
            ->delete();
    }
};
