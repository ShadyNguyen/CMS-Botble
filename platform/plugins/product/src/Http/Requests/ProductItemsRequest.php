<?php

namespace Botble\Product\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ProductItemsRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:220',
            'category_id' => 'required',
            'price' => 'required',
            'description' => 'nullable|string',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
