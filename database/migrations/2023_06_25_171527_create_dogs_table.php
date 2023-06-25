<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->jsonb('data')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dogs');
    }
};
