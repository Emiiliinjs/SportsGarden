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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable(); // Apmeklētāja IP adrese
            $table->string('user_agent')->nullable(); // Browser / Device info
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Ja lietotājs pieslēdzies
            $table->timestamps(); // created_at = apmeklējuma laiks
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
