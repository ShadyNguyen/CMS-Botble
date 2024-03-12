<?php

namespace Botble\Product\Tables;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Product\Models\ProductItems;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;
use Botble\Table\DataTables;
use Botble\Product\Models\ProductCategories;

class ProductItemsTable extends TableAbstract
{
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, ProductItems $productItems)
    {
        parent::__construct($table, $urlGenerator);
        $this->model = $productItems;

        $this->hasActions = true;
        $this->hasFilter = true;

        if (!Auth::user()->hasAnyPermission(['product-items.edit', 'product-items.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    public function ajax(): JsonResponse
    {
        $data = $this->table
            ->eloquent($this->query())
            ->with('category') // Eager load the category relationship
            ->editColumn('name', function (ProductItems $item) {
                if (!Auth::user()->hasPermission('product-items.edit')) {
                    return BaseHelper::clean($item->name);
                }
                return Html::link(route('product-items.edit', $item->getKey()), BaseHelper::clean($item->name));
            })
            ->editColumn('image', function (ProductItems $item) {
                return $this->displayThumbnail($item->image);
            })
            ->editColumn('description', function (ProductItems $item) {
                return BaseHelper::clean($item->description); // Assuming description is a text field
            })
            ->editColumn('quantity', function (ProductItems $item) {
                return number_format($item->quantity, 2); // Assuming price is a decimal field
            })
            ->editColumn('price', function (ProductItems $item) {
                return number_format($item->price, 3); // Assuming price is a decimal field
            })
            ->editColumn('category', function (ProductItems $item) {
                return $item->category->name ?? ''; // Display category name or an empty string if not available
            })
            ->editColumn('checkbox', function (ProductItems $item) {
                return $this->getCheckbox($item->getKey());
            })
            ->editColumn('created_at', function (ProductItems $item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('status', function (ProductItems $item) {
                return $item->status->toHtml();
            })
            ->addColumn('operations', function (ProductItems $item) {
                return $this->getOperations('product-items.edit', 'product-items.destroy', $item);
            });

        return $this->toJson($data);
    }


    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this
            ->getModel()
            ->query()
            ->select([
                'id',
                'name',
                'image',
                'quantity',
                'description',
                'price',
                'category_id',
                'created_at',
                'status',
            ]);

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            'id' => [
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'name' => [
                'title' => trans('core/base::tables.name'),
                'class' => 'text-start',
            ],
            'description' => [
                'description' => 'Description',
                'class' => 'text-start',
            ],
            'image' => [
                'image' => 'Image',
                'class' => 'text-start',
            ],
            'quantity' => [
                'quantity' => 'Quantity',
                'class' => 'text-start',
            ],
            'price' => [
                'price' => 'Price',
                'class' => 'text-start',
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    public function buttons(): array
    {
        return $this->addCreateButton(route('product-items.create'), 'product-items.create');
    }

    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('product-items.deletes'), 'product-items.destroy', parent::bulkActions());
    }

    public function getBulkChanges(): array
    {
        return [
            'name' => [
                'title' => trans('core/base::tables.name'),
                'type' => 'text',
                'validate' => 'required|max:120',
            ],
            'price' => [
                'title' => 'Price',
                'type' => 'float',    
            ],
            'status' => [
                'title' => trans('core/base::tables.status'),
                'type' => 'select',
                'choices' => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type' => 'date',
            ],
        ];
    }


    public function getCategories() {
        return ProductCategories::query()->pluck('id','name')->all();
    }
    public function getFilters(): array
    {
        return $this->getBulkChanges();
    }
}
