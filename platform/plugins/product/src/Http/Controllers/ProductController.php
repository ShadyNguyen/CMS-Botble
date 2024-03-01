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

class ProductController extends BaseController
{
    public function index(ProductTable $table)
    {
        PageTitle::setTitle(trans('plugins/product::product.name'));

        return $table->renderTable();
    }

    public function create(FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('plugins/product::product.create'));

        return $formBuilder->create(ProductForm::class)->renderForm();
    }

    public function store(ProductRequest $request, BaseHttpResponse $response)
    {
        $product = Product::query()->create($request->input());

        event(new CreatedContentEvent(PRODUCT_MODULE_SCREEN_NAME, $request, $product));

        return $response
            ->setPreviousUrl(route('product.index'))
            ->setNextUrl(route('product.edit', $product->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Product $product, FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('core/base::forms.edit_item', ['name' => $product->name]));

        return $formBuilder->create(ProductForm::class, ['model' => $product])->renderForm();
    }

    public function update(Product $product, ProductRequest $request, BaseHttpResponse $response)
    {
        $product->fill($request->input());

        $product->save();

        event(new UpdatedContentEvent(PRODUCT_MODULE_SCREEN_NAME, $request, $product));

        return $response
            ->setPreviousUrl(route('product.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Product $product, Request $request, BaseHttpResponse $response)
    {
        try {
            $product->delete();

            event(new DeletedContentEvent(PRODUCT_MODULE_SCREEN_NAME, $request, $product));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    public function deletes(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $product = Product::query()->findOrFail($id);
            $product->delete();
            event(new DeletedContentEvent(PRODUCT_MODULE_SCREEN_NAME, $request, $product));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
