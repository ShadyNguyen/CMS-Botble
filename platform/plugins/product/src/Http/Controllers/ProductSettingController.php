<?php

namespace App\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Requests\UpdateSettingsRequest;
use Botble\Product\Repositories\Interfaces\ProductSettingRepository;

class ProductSettingController extends BaseController
{
    /**
     * @var ProductSettingRepository
     */
    protected $productSettingRepository;

    public function __construct(ProductSettingRepository $productSettingRepository)
    {
        $this->productSettingRepository = $productSettingRepository;
    }

    public function index()
    {
        $settings = $this->productSettingRepository->all();

        return view('plugins/product::settings.index', compact('settings'));
    }

    public function save(UpdateSettingsRequest $request)
    {
        $this->productSettingRepository->update($request->except('_token'));

        return redirect()->route('settings.product')->with('success', 'Cập nhật cài đặt thành công');
    }
}
