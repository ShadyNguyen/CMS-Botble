<?php

namespace Theme\July\Http\Controllers;

use Botble\Theme\Http\Controllers\PublicController;

class JulyController extends PublicController
{
    public function getProduct()
    {
        
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
