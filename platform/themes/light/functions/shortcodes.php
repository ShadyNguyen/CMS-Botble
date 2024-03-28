<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

app()->booted(function () {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    if (is_plugin_active('blog')) {
        // add_shortcode('featured-news', __('Featured News'), __('Featured News'), function ($shortcode) {
        //     return Theme::partial('shortcodes.featured-news', compact('shortcode'));
        //     //view sẽ hiển thị ra admin
        // });

        shortcode()->setAdminConfig('featured-news', function ($attributes, $content) {
            //view sẽ hiển thị bên front-end
            return Theme::partial('shortcodes.featured-news-admin', compact('attributes', 'content'));
            //file view nằm trong themes/your-theme/partials/shortcodes.code-block-name-admin-config.blade.php
        });
        shortcode()->setAdminConfig('featured-category', function ($attributes, $content) {
            //view sẽ hiển thị bên front-end
            return Theme::partial('shortcodes.featured-category-admin', compact('attributes', 'content'));
            //file view nằm trong themes/your-theme/partials/shortcodes.code-block-name-admin-config.blade.php
        });
        shortcode()->setAdminConfig('main-news', function ($attributes, $content) {
            //view sẽ hiển thị bên front-end
            return Theme::partial('shortcodes.main-news-admin', compact('attributes', 'content'));
            //file view nằm trong themes/your-theme/partials/shortcodes.code-block-name-admin-config.blade.php
        });
        shortcode()->setAdminConfig('news-with-sidebar', function ($attributes, $content) {
            //view sẽ hiển thị bên front-end
            return Theme::partial('shortcodes.news-with-sidebar-admin', compact('attributes', 'content'));
            //file view nằm trong themes/your-theme/partials/shortcodes.code-block-name-admin-config.blade.php
        });
        shortcode()->setAdminConfig('top-news-slider', function ($attributes, $content) {
            //view sẽ hiển thị bên front-end
            return Theme::partial('shortcodes.top-news-slider-admin', compact('attributes', 'content'));
            //file view nằm trong themes/your-theme/partials/shortcodes.code-block-name-admin-config.blade.php
        });
    }
});
