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
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->uuid('submission_token')->unique();
            $table->string('name');
            $table->string('company');
            $table->string('position')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('estimated_users')->nullable();
            $table->json('needs')->nullable();
            $table->text('message');
            $table->string('status', 20)->default('NUEVO');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};
