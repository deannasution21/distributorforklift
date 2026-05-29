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
        $columns = ['title', 'label', 'subtitle', 'cta_text', 'cta_url', 'is_published', 'published_at'];
        $existing = array_filter($columns, fn($col) => Schema::hasColumn('contact_page', $col));

        if (!empty($existing)) {
            Schema::table('contact_page', function (Blueprint $table) use ($existing) {
                $table->dropColumn(array_values($existing));
            });
        }
    }

    public function down(): void
    {
        Schema::table('contact_page', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('label')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
        });
    }
};
