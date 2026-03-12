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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable(); // Profile image
            $table->string('phone')->nullable(); // Phone
            $table->string('address')->nullable(); // Address
            $table->string('city')->nullable(); // City
            $table->string('country')->nullable(); // Country
            $table->enum('gender', ['male', 'female'])->default('male'); // Gender
            $table->longText('experience')->nullable(); // Experience
            $table->string('job_title')->nullable(); // Job Title
            $table->string('department')->nullable(); // Department
            $table->text('skills')->nullable(); // Skills
            $table->string('website')->nullable(); // Website / LinkedIn
            $table->longText('bio')->nullable(); // Bio
            $table->enum('role', ['user', 'instructor', 'admin'])->default('user'); // Role
            $table->enum('status', ['0', '1'])->default('1'); // Active/Inactive
            $table->integer('day')->nullable(); // Day of birth
            $table->string('month')->nullable(); // Month of birth
            $table->integer('year')->nullable(); // Year of birth
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};