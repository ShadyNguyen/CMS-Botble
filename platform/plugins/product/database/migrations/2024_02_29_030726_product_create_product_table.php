<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('products_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('products_id');
            $table->string('name', 255)->nullable();

            $table->primary(['lang_code', 'products_id'], 'products_translations_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('products_translations');
    }
};
