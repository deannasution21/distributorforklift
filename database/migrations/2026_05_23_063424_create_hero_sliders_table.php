<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('show_cta')->default(false);
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sliders');
    }
};
