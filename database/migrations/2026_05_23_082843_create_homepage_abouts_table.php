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
        Schema::create('homepage_abouts', function (Blueprint $table) {
            $table->id();
            $table->string('section_title')->default('Tentang Perusahaan');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('box_title')->nullable();
            $table->text('box_description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('show_cta')->default(false);
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();
            $table->longText('long_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_abouts');
    }
};
