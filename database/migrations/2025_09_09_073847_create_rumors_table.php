<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumorsTable extends Migration
{
    public function up(): void
    {
        Schema::create('rumors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable(); // store image path
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rumors');
    }
}
