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
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_verification_token')->nullable()->after('email_verified_at');
            $table->timestamp('email_verification_token_expires_at')->nullable()->after('email_verification_token');
            $table->string('phone_verification_code')->nullable()->after('phone_number');
            $table->timestamp('phone_verification_code_expires_at')->nullable()->after('phone_verification_code');
            $table->boolean('phone_verified')->default(false)->after('phone_verification_code_expires_at');
            $table->enum('verification_status', ['pending', 'email_verified', 'phone_verified', 'documents_uploaded', 'approved', 'rejected'])->default('pending')->after('phone_verified');
            $table->text('rejection_reason')->nullable()->after('verification_status');
            $table->string('ip_address')->nullable()->after('rejection_reason');
            $table->string('user_agent')->nullable()->after('ip_address');
            $table->timestamp('last_verification_attempt')->nullable()->after('user_agent');
            $table->integer('verification_attempts')->default(0)->after('last_verification_attempt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'email_verification_token',
                'email_verification_token_expires_at',
                'phone_verification_code',
                'phone_verification_code_expires_at',
                'phone_verified',
                'verification_status',
                'rejection_reason',
                'ip_address',
                'user_agent',
                'last_verification_attempt',
                'verification_attempts'
            ]);
        });
    }
};