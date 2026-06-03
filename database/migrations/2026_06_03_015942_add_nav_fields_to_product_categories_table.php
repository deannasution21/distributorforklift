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
        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('nav_group')->nullable()->after('is_active');
            $table->string('nav_sub')->nullable()->after('nav_group');
            $table->string('nav_label')->nullable()->after('nav_sub');
            $table->boolean('show_in_nav')->default(false)->after('nav_label');
            $table->boolean('show_inquiry')->default(true)->after('show_in_nav');
        });
    }

    public function down(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn(['nav_group', 'nav_sub', 'nav_label', 'show_in_nav', 'show_inquiry']);
        });
    }
};
