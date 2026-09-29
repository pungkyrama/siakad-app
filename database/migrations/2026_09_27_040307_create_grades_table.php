<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('krs_detail_id')->constrained()->cascadeOnDelete();
            $table->decimal('numeric_score', 5, 2)->nullable();
            $table->enum('letter_grade', ['A', 'B', 'C', 'D', 'E'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
