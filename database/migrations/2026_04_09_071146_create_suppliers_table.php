<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();

            $table->string('name', 150);
            $table->string('mobile', 30)->index();
            $table->text('address')->nullable();

            $table->string('contact_person', 150)->nullable();
            $table->string('contact_person_designation', 150)->nullable();

            $table->decimal('credit_limit', 15, 2)->default(0);
            $table->decimal('credit', 15, 2)->default(0);

            $table->text('remark')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
            $table->index(['name', 'mobile']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};