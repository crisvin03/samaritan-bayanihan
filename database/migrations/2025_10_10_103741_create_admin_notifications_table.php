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
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // new_member, id_uploaded, benefit_request, contribution_made, etc.
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // Additional data like user_id, amount, etc.
            $table->boolean('read')->default(false);
            $table->string('priority')->default('normal'); // low, normal, high, urgent
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_notifications');
    }
};
