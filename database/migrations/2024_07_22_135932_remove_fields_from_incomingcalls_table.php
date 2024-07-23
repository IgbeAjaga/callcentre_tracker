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
        Schema::table('incomingcalls', function (Blueprint $table) {
            $table->dropColumn(['call', 'customer', 'phone']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incomingcalls', function (Blueprint $table) {
            $table->string('call')->nullable();
            $table->string('customer')->nullable();
            $table->string('phone')->nullable();
        });
    }
};
