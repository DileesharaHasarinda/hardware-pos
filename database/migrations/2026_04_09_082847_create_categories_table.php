<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->string('name', 150);
            $table->string('code', 50);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index('parent_id');
            $table->index(['parent_id', 'name']);
            $table->index(['parent_id', 'code']);
            $table->unique(['parent_id', 'name']);
            $table->unique(['parent_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};