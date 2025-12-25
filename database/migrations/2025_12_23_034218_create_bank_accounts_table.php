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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('bank_account_holder');
            $table->string('bank_account_number');
            $table->string('bank_ifsc')->nullable();
            $table->string('bank_name')->nullable();

            $table->string('upi_id')->nullable();
            $table->string('qr_code_img')->nullable();

            $table->boolean('is_primary')->default(false);

            $table->enum('created_by', ['user', 'admin'])
                ->default('user');
                
            $table->timestamps();

            $table->index(['user_id', 'is_primary']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
