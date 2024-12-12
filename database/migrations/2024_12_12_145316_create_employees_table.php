<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('section')->cascadeOnDelete();
            $table->string('salary_type');
            $table->integer('salary');
            $table->decimal('bonus', 5, 3);
            $table->integer('workhours');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
