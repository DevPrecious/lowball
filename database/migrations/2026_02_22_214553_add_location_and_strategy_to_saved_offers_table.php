<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('saved_offers', function (Blueprint $table) {
            $table->string('location')->nullable()->after('company_name');
            $table->text('strategy')->nullable()->after('lowball_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saved_offers', function (Blueprint $table) {
            $table->dropColumn(['location', 'strategy']);
        });
    }
};
