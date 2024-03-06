<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('product_items_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('product_items_id');
            $table->string('name', 255)->nullable();

            $table->primary(['lang_code', 'product_items_id'], 'product_items_translations_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_items');
        Schema::dropIfExists('product_items_translations');
    }
};
