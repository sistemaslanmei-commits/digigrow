<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');                      // Ej: Sede Ate, San Borja, etc.
            $table->string('tag')->nullable();           // Ej: Nuestra tienda, Atención online, Sede Principal
            $table->text('address')->nullable();         // Dirección o descripción corta
            $table->string('icon')->default('bi-geo-alt-fill'); // Icono Bootstrap
            $table->text('map_url')->nullable();         // Enlace a Google Maps o WhatsApp
            $table->string('button_text')->default('Cómo llegar'); // Texto del botón
            $table->string('image')->nullable();         // Imagen de la tienda
            $table->boolean('is_active')->default(true); // Para activar/desactivar
            $table->unsignedInteger('sort_order')->default(0); // Orden de aparición
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
