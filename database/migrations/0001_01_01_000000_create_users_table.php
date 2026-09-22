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
            $table->string('name'); // ব্যবহারকারীর নাম
            $table->string('email')->unique(); // অফিসিয়াল ইমেইল
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // --- কাস্টম ফিল্ড শুরু ---
            $table->string('designation')->nullable(); // পদবী (যেমন: অফিস সহকারী, সেকশন অফিসার)
            $table->string('phone_number')->nullable(); // যোগাযোগের নম্বর
            $table->string('role')->default('user'); // 'admin' বা 'user' হিসেবে ব্যবহার করা যেতে পারে
            $table->boolean('is_active')->default(true); // সিস্টেম ব্যবহার করতে পারবে কি না
            // --- কাস্টম ফিল্ড শেষ ---
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
