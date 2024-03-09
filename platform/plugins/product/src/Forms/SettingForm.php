<?php

namespace Botble\Product\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Product\Http\Requests\ProductRequest;
use Botble\Product\Models\Product;
use Botble\Base\Forms\FormBuilder;
use Illuminate\Http\Request;
use Botble\Base\Http\Responses\BaseHttpResponse;

class SettingForm extends FormAbstract
{
    /**
     * Get setting
     */
    public function buildForm(): void
    {
        $this
            ->setupModel(new Product)
            ->setValidatorClass(ProductRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('Test setting'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => 'try it!',
                    'data-counter' => 120,
                ],
            ])
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices' => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}

