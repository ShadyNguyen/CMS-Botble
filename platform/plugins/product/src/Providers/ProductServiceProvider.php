<?php

namespace Botble\Product\Providers;

use Botble\Product\Models\Product;
use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Supports\ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;

class ProductServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/product')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes();

        if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Product::class, [
                'name',
            ]);
            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(\Botble\Product\Models\ProductCategories::class, [
                'name',
            ]);
            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(\Botble\Product\Models\ProductItems::class, [
                'name',
            ]);
        }

        $this->app['events']->listen(RouteMatched::class, function () {
            DashboardMenu::registerItem([
                'id' => 'cms-plugins-product',
                'priority' => 5,
                'parent_id' => null,
                'name' => 'plugins/product::product.name',
                'icon' => 'fa fa-list',
                'url' => route('product.index'),
                'permissions' => ['product.index'],
            ]);
            \Botble\Base\Facades\DashboardMenu::registerItem([
                'id' => 'cms-plugins-product-categories',
                'priority' => 0,
                'parent_id' => 'cms-plugins-product',
                'name' => 'plugins/product::product-categories.name',
                'icon' => null,
                'url' => route('product-categories.index'),
                'permissions' => ['product-categories.index'],
            ]);
            \Botble\Base\Facades\DashboardMenu::registerItem([
                'id' => 'cms-plugins-product-items',
                'priority' => 0,
                'parent_id' => 'cms-plugins-product',
                'name' => 'plugins/product::product-items.name',
                'icon' => null,
                'url' => route('product-items.index'),
                'permissions' => ['product-items.index'],
            ]);
        });

        add_filter(BASE_FILTER_AFTER_SETTING_CONTENT,[$this, 'productSetting'],200 ,1);
    }

    public function productSetting($data)
    {
        return $data . view('plugins/product::setting')->render();
    }
}
