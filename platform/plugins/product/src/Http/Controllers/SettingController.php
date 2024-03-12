<?php

namespace Botble\Product\Http\Controllers;

use Botble\Product\Http\Requests\ProductRequest;
use Botble\Product\Models\Product;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Product\Tables\ProductTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Product\Forms\ProductForm;
use Botble\Base\Forms\FormBuilder;
use Botble\Product\Forms\SettingForm;

class SettingController extends BaseController
{
    protected function saveSettings(array $data): void
    {
        foreach ($data as $settingKey => $settingValue) {
            if (is_array($settingValue)) {
                $settingValue = json_encode(array_filter($settingValue));
            }

            setting()->set($settingKey, (string)$settingValue);
        }

        setting()->save();
    }

    public function getSetting()
    {
        page_title()->setTitle('Product');
        // $productTypes = require __DIR__ . '/settings.php';

        return view('plugins/product::index');
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postSetting(Request $request, BaseHttpResponse $response)
    {
        $this->saveSettings($request->except(['_token']));

        return $response
            ->setPreviousUrl(route('settings.product.post'))
            //route có sẵn khi tạo plugin
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

}
