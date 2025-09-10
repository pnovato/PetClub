<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('species')->index(); // dog, cat
            $table->enum('sex', ['male','female']);
            $table->unsignedTinyInteger('age_years')->nullable();
            $table->enum('size', ['small','medium','large'])->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['available','reserved','adopted'])->default('available')->index();
            $table->foreignId('adopted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('adopted_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
