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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company');
            $table->string('location');
            $table->enum('job_type', ['Full-time', 'Part-time', 'Contract', 'Remote', 'Internship']);
            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();
            $table->text('description');
            $table->text('responsibilities');
            $table->text('requirements');
            $table->text('perks')->nullable();
            $table->date('application_deadline');
            $table->string('contact_email');
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
