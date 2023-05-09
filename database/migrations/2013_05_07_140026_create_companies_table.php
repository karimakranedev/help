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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();

            $table->integer('founded_year')->nullable();

            $table->string('website')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();

            $table->string('patente')->nullable()->unique();
            $table->string('if')->nullable()->unique();
            $table->string('rc')->nullable()->unique();
            $table->string('ice')->nullable()->unique();
            $table->string('cnss')->nullable()->unique();

            $table->string('country')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();

            $table->boolean('is_active')->default(false);

            $table->string('full_address')->virtualAs(
                "CONCAT(street, ', ', zip, ' ', city, ', ', country)"
            );


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
