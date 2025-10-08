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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // announcement, benefit_approved, benefit_rejected, contribution_validated, etc.
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // Additional data like benefit_id, announcement_id, etc.
            $table->boolean('read')->default(false);
            $table->string('priority')->default('medium'); // low, medium, high
            $table->timestamp('read_at')->nullable();
            $table->morphs('notifiable'); // user_id and user_type
            $table->timestamps();
            
            $table->index(['notifiable_type', 'notifiable_id']);
            $table->index(['read', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
