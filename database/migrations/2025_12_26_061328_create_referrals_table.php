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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            
            // who shared the referral
            $table->foreignId('referrer_user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // who used the referral
            $table->foreignId('referred_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('referral_code');
            $table->timestamp('used_at')->nullable();

            $table->timestamps();

            // prevent duplicate usage
            $table->unique(['referrer_user_id', 'referred_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
