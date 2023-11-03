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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->decimal('salary_from');
            $table->decimal('salary_to');
            $table->tinyInteger('employemnt_type')->comment('1-full-time, 2-part-time, 3-contract');
            $table->boolean('status')->comment('0-closed, 1-opened');
            $table->dateTime('posted_at');
            $table->dateTime('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
