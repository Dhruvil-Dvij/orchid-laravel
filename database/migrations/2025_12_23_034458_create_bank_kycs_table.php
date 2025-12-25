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
        Schema::create('bank_kycs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bank_account_id')
                ->constrained()
                ->cascadeOnDelete()
                ->unique();

            $table->string('passbook_img');

            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->text('admin_comment')->nullable();
            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_kycs');
    }
};
