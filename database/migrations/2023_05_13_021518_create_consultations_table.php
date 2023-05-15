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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();//
            $table->uuid('uuid')->unique();

            $table->foreignId('consultation_type_id')->constrained();

            $table->string('name');
            $table->string('reference');

            $table->foreignId('organisme_id')->constrained();
            $table->string('sous_organisme')->nullable();

            $table->mediumText('objet');

            $table->string('ministere')->nullable();
            $table->string('classe')->nullable();
            $table->string('secteur')->nullable();
            $table->string('qualification')->nullable();
            $table->string('agreement')->nullable();

            $table->boolean('is_unique_lot')->default(false);
            $table->boolean('is_http_submission')->default(false);
            $table->string('http_submission')->nullable();

            $table->boolean('is_site_visit')->default(false);
            $table->string('execution_address')->nullable();
            $table->string('execution_city')->nullable();

            $table->string('estimation_price')->nullable();
            $table->string('caution')->nullable();

            $table->boolean('is_small_entity')->default(false);

            $table->string('pick_up_address')->nullable();
            $table->string('bid_address')->nullable();
            $table->string('bid_opening_address')->nullable();

            $table->string('plans_acquisition_price')->nullable();
            $table->string('montant_retrait')->nullable();

            $table->string('delai_execution')->nullable();


            $table->string('administration_contact')->nullable();

            $table->string('observation')->nullable();

            $table->date('date_publication')->nullable();
            $table->date('date_ouverture')->nullable();
            $table->date('date_reunion')->nullable();
            $table->date('date_echantillon')->nullable();
            $table->date('date_visite_lieux')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
