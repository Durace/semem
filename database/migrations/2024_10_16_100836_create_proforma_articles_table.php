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
        Schema::create('proforma_articles', function (Blueprint $table) {
            $table->id();
            $table->string('codeProforma', 191);
            $table->string('designation', 191);
            $table->decimal('pu', 10, 2);
            $table->integer('qte');
            $table->decimal('remise', 5, 2)->nullable();
            $table->string('uv', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proforma_articles');
    }
};
