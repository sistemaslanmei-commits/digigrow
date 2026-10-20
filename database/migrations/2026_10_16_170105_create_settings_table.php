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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('DigiGrow');
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();            
            /// Logotipo e Imagen Institucional
            $table->string('logo')->nullable();           // Logotipo principal
            
            // Banners independientes por cada página
            $table->string('home_banner')->nullable();    // Banner opcional cabecera Home
            $table->string('about_banner')->nullable();   // Banner de la página Nosotros
            $table->string('contact_banner')->nullable(); // Banner de la página Contacto
            $table->string('catalogo_banner')->nullable(); // Banner de la página Catálogo
            $table->string('services_banner')->nullable();// Banner de la página Servicios
            $table->string('brands_banner')->nullable();  // Banner de la página Marcas
            
            // Redes Sociales
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
