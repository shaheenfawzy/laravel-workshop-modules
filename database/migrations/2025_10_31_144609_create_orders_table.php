<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->json('customer')->nullable();
            $table->unsignedMediumInteger('subtotal');
            $table->unsignedMediumInteger('tax')->default(0);
            $table->unsignedMediumInteger('discount')->default(0);
            $table->unsignedMediumInteger('total');
            $table->string('status');
            $table->foreignId('customer_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
