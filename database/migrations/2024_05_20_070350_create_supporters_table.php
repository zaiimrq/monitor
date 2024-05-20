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
        Schema::create('supporters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timses_id')->constrained('timses')->cascadeOnDelete();
            $table->unsignedBigInteger('nik');
            $table->string('name');
            $table->string('gender');
            $table->string('religion');
            $table->string('rt');
            $table->string('village');
            $table->string('district');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supporters');
    }
};
