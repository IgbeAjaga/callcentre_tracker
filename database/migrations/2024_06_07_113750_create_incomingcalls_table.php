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
        Schema::create('incomingcalls', function (Blueprint $table) {
            $table->id();
            $table->string('branchcalled');
            $table->string('drug');
            $table->string('call');
            $table->string('response');
            $table->string('customer');
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomingcalls');
    }
};
