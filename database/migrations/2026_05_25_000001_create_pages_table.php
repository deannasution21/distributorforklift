<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('label')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('heading')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();
            $table->string('image')->nullable();
            $table->longText('content')->nullable();
            $table->string('nav_group')->nullable();
            $table->string('nav_sub')->nullable();
            $table->string('nav_label')->nullable();
            $table->boolean('show_in_nav')->default(false);
            $table->boolean('show_inquiry')->default(false);
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
