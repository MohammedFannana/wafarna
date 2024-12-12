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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users' ,'id')->cascadeOnDelete();
            $table->foreignId('plan_id')->nullable()->constrained('plans' ,'id')->nullOnDelete();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->enum('is_subscribed', ['true', 'false'])->nullable();
            $table->date('start_subscription_data')->nullable();
            $table->date('subscription_end_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
