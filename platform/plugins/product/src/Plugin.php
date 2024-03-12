<?php

namespace Botble\Product;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('products_translations');

        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('product_categories_translations');

        Schema::dropIfExists('product_items');
        Schema::dropIfExists('product_items_translations');
    }
}
