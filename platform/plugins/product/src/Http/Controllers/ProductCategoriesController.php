<?php

namespace Botble\Product\Http\Controllers;

use Botble\Product\Http\Requests\ProductCategoriesRequest;
use Botble\Product\Models\ProductCategories;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Product\Tables\ProductCategoriesTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Product\Forms\ProductCategoriesForm;
use Botble\Base\Forms\FormBuilder;

class ProductCategoriesController extends BaseController
{
    public function index(ProductCategoriesTable $table)
    {
        PageTitle::setTitle(trans('plugins/product::product-categories.name'));

        return $table->renderTable();
    }

    public function create(FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('plugins/product::product-categories.create'));

        return $formBuilder->create(ProductCategoriesForm::class)->renderForm();
    }

    public function store(ProductCategoriesRequest $request, BaseHttpResponse $response)
    {
        $productCategories = ProductCategories::query()->create($request->input());

        event(new CreatedContentEvent(PRODUCT_CATEGORIES_MODULE_SCREEN_NAME, $request, $productCategories));

        return $response
            ->setPreviousUrl(route('product-categories.index'))
            ->setNextUrl(route('product-categories.edit', $productCategories->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(ProductCategories $productCategories, FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('core/base::forms.edit_item', ['name' => $productCategories->name]));

        return $formBuilder->create(ProductCategoriesForm::class, ['model' => $productCategories])->renderForm();
    }

    public function update(ProductCategories $productCategories, ProductCategoriesRequest $request, BaseHttpResponse $response)
    {
        $productCategories->fill($request->input());

        $productCategories->save();

        event(new UpdatedContentEvent(PRODUCT_CATEGORIES_MODULE_SCREEN_NAME, $request, $productCategories));

        return $response
            ->setPreviousUrl(route('product-categories.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(ProductCategories $productCategories, Request $request, BaseHttpResponse $response)
    {
        try {
            $productCategories->delete();

            event(new DeletedContentEvent(PRODUCT_CATEGORIES_MODULE_SCREEN_NAME, $request, $productCategories));

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
            $productCategories = ProductCategories::query()->findOrFail($id);
            $productCategories->delete();
            event(new DeletedContentEvent(PRODUCT_CATEGORIES_MODULE_SCREEN_NAME, $request, $productCategories));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
