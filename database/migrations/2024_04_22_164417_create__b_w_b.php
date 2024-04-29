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
        Schema::create('bwbTable', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->unique()->nullable(false);
            $table->date('date')->nullable(false);
            $table->string('link', 100)->nullable(false);
            $table->string('register_image')->nullable(false);
            $table->string('join_image')->nullable(false);
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->nullable(false);
            $table->enum('coach_name', ['coach1', 'coach2'])->nullable(false);
            $table->string('coach_description')->nullable(false);
            $table->string('coach_image')->nullable(false);
            $table->enum('language', ['english', 'hindi'])->nullable(false);
            $table->string('session_time')->nullable(false);
            $table->enum('session_label', ['workshop', 'training'])->nullable(false);
            $table->enum('session_type', ['live', 'recorded'])->nullable(false);
            $table->string('description')->nullable(false);
            $table->string('dos_and_donts')->nullable();
            $table->string('health_details')->nullable();
            $table->string('faqs')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bwbTable');
    }
};
