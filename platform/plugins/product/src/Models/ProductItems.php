<?php

namespace Botble\Product\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class ProductItems extends BaseModel
{
    protected $table = 'product_items';

    protected $fillable = [
        'name',
        'status',
        'category_id',
        'image',
        'description',
        'price',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'description' => SafeContent::class,
    ];
}
