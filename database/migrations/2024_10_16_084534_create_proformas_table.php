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
        Schema::create('proformas', function (Blueprint $table) {
            $table->id();
            $table->string('numProforma', 191)->unique();
            $table->date('date');
            $table->time('heure');
            $table->string('typeProforma', 191);
            $table->string('typeFiscal', 191);
            $table->string('client', 191);
            $table->string('acheteur', 191)->nullable();
            $table->string('commercial', 191);
            $table->string('vendeur', 191);
            $table->string('da', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proformas');
    }
};
