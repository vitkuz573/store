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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10)->default(0);
            $table->enum('status', ['Ожидает', 'В обработке', 'Доставляется', 'Доставлен'])->default('Ожидает');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email');
            $table->string('shipping_address');
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
