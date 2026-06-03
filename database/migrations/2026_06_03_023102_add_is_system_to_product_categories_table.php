<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->boolean('is_system')->default(false)->after('show_inquiry');
        });

        // Insert the system "All Products" category
        DB::table('product_categories')->insert([
            'name'         => 'Produk',
            'slug'         => 'semua-produk',
            'description'  => null,
            'image'        => null,
            'sort_order'   => 0,
            'is_active'    => true,
            'is_system'    => true,
            'show_in_nav'  => false,
            'show_inquiry' => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('product_categories')->where('is_system', true)->delete();

        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn('is_system');
        });
    }
};
