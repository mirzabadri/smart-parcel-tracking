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
        Schema::table('parcels', function (Blueprint $table) {
            //
            Schema::table('parcels', function (Blueprint $table) {
                $table->dropColumn('status');
            });

            Schema::table('parcels', function (Blueprint $table) {
                $table->enum('status', ['created', 'picked_up', 'departed', 'out_for_delivery', 'delivered'])
                    ->default('created')
                    ->after('description');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            //
            Schema::table('parcels', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        });
    }
};
