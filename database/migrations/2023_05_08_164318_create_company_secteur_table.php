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
        Schema::create('company_secteur', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained();
            $table->foreignId('secteur_id')->nullable()->constrained();
            $table->primary(['company_id', 'secteur_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_secteur');
    }
};
