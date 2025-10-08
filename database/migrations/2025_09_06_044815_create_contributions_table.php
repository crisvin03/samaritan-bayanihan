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
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('recorded_by')->constrained('users'); // Who recorded this contribution
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['weekly_savings', 'special_contribution', 'penalty', 'other']);
            $table->string('reference_number')->nullable(); // Receipt or reference number
            $table->text('description')->nullable();
            $table->string('proof_of_payment')->nullable(); // File path to uploaded proof
            $table->enum('status', ['pending', 'validated', 'rejected'])->default('pending');
            $table->text('validation_notes')->nullable();
            $table->date('contribution_date');
            $table->timestamps();

            $table->index(['user_id', 'contribution_date']);
            $table->index(['status', 'contribution_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};