<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_group_id')
                ->nullable()
                ->constrained('customer_groups')
                ->nullOnDelete();

            $table->string('code', 50)->unique();
            $table->string('name', 150);
            $table->string('mobile', 30)->nullable()->index();
            $table->text('address')->nullable();

            $table->decimal('credit_limit', 15, 2)->default(0);
            $table->decimal('sales', 15, 2)->default(0);
            $table->decimal('sales_return', 15, 2)->default(0);

            $table->boolean('is_blocked')->default(false);
            $table->text('remark')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['name', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
