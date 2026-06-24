<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->enum('prioridad', ['Baja', 'Media', 'Alta'])->default('Media');
            $table->date('fecha_vencimiento')->nullable();
            $table->string('archivo')->nullable();
            $table->boolean('completado')->default(false);
            $table->foreignId('progreso_id')->constrained('progreso')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};