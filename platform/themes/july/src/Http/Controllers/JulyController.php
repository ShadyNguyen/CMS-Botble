<?php

namespace Theme\July\Http\Controllers;

use Botble\Theme\Http\Controllers\PublicController;
use Botble\Theme\Facades\Theme;
use Symfony\Contracts\Cache\CacheInterface;


class JulyController extends PublicController
{
    public function getProduct()
    {
        return Theme::scope('product')->render();
    }
    public function getIndex()
    {
        return parent::getIndex();
    }

    public function getView(?string $key = null)
    {
        return parent::getView($key);
    }

    public function getSiteMapIndex(string $key = null, string $extension = 'xml')
    {
        return parent::getSiteMapIndex();
    }
}
