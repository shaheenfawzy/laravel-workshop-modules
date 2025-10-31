<?php

use App\Models\Tenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sequences', function (Blueprint $table) {
            $table->string('column');
            $table->unsignedBigInteger('last')->default(1);
            $table->string('sequencable_type');
            $table->unique(['column', 'sequencable_type', 'last'], 'uniqe_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sequences');
    }
};