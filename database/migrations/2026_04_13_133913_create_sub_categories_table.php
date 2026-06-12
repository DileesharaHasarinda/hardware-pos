<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('master_category_id')
                ->constrained('master_categories')
                ->restrictOnDelete();

            $table->string('name', 150);
            $table->string('code', 50);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index('master_category_id');
            $table->index(['master_category_id', 'name']);
            $table->index(['master_category_id', 'code']);

            $table->unique(['master_category_id', 'name']);
            $table->unique(['master_category_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};