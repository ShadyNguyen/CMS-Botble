<?php

namespace Theme\Wofl\Http\Controllers;

use Botble\Theme\Http\Controllers\PublicController;
use Botble\Theme\Facades\Theme;
class WoflController extends PublicController
{
    public function getExample()
    {
        return Theme::layout('category')->scope('example', ['data' => 123])->render();
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
