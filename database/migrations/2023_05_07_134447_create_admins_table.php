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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->enum('title', ['Mr.', 'Mme.', 'Mlle.'])->default('Mr.');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('name')->virtualAs("CONCAT(first_name,' ',last_name)");
            $table->string('email')->unique();
            $table->string('phone')->unique();

            $table->boolean('is_owner')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_super_admin')->default(false);

            $table->string('country')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();

            $table->string('full_address')->virtualAs(
                "CONCAT(street, ', ', zip, ' ', city, ', ', country)"
            );

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
