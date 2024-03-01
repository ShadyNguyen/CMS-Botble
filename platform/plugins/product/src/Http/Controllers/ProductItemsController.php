<?php

namespace Botble\Product\Http\Controllers;

use Botble\Product\Http\Requests\ProductItemsRequest;
use Botble\Product\Models\ProductItems;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Product\Tables\ProductItemsTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Product\Forms\ProductItemsForm;
use Botble\Base\Forms\FormBuilder;

class ProductItemsController extends BaseController
{
    public function index(ProductItemsTable $table)
    {
        PageTitle::setTitle(trans('plugins/product::product-items.name'));

        return $table->renderTable();
    }

    public function create(FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('plugins/product::product-items.create'));

        return $formBuilder->create(ProductItemsForm::class)->renderForm();
    }

    public function store(ProductItemsRequest $request, BaseHttpResponse $response)
    {
        $productItems = ProductItems::query()->create($request->input());

        event(new CreatedContentEvent(PRODUCT_ITEMS_MODULE_SCREEN_NAME, $request, $productItems));

        return $response
            ->setPreviousUrl(route('product-items.index'))
            ->setNextUrl(route('product-items.edit', $productItems->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(ProductItems $productItems, FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('core/base::forms.edit_item', ['name' => $productItems->name]));

        return $formBuilder->create(ProductItemsForm::class, ['model' => $productItems])->renderForm();
    }

    public function update(ProductItems $productItems, ProductItemsRequest $request, BaseHttpResponse $response)
    {
        $productItems->fill($request->input());

        $productItems->save();

        event(new UpdatedContentEvent(PRODUCT_ITEMS_MODULE_SCREEN_NAME, $request, $productItems));

        return $response
            ->setPreviousUrl(route('product-items.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(ProductItems $productItems, Request $request, BaseHttpResponse $response)
    {
        try {
            $productItems->delete();

            event(new DeletedContentEvent(PRODUCT_ITEMS_MODULE_SCREEN_NAME, $request, $productItems));

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
            $productItems = ProductItems::query()->findOrFail($id);
            $productItems->delete();
            event(new DeletedContentEvent(PRODUCT_ITEMS_MODULE_SCREEN_NAME, $request, $productItems));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
