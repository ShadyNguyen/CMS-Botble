<?php

namespace Botble\Product\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Product\Http\Requests\ProductItemsRequest;
use Botble\Product\Models\ProductItems;

class ProductItemsForm extends FormAbstract
{
    public function buildForm(): void
    {
        $this
            ->setupModel(new ProductItems)
            ->setValidatorClass(ProductItemsRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required focus'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('description', 'editor', [
                'label'=> __('Description'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'with-short-code' => false, // if true, it will add a button to select shortcode
                    'without-buttons' => false, // if true, all buttons will be hidden
                ],
            ])
            ->add('price', 'number', [ // you can change "text" to "password", "email", "number" or "textarea"
                'label' => __('Price'),
                'label_attr' => ['class' => 'control-label required'], // Add class "required" if that is mandatory field
                'attr' => [
                    'placeholder' => __('Price...'),
                    'data-counter' => 120, // Maximum characters
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
            ->add('image', 'mediaImage', [
                'label' => __('Image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('category_id', 'customSelect', [ // Change "select" to "customSelect" for better UI
                'label' => __('Category'),
                'label_attr' => ['class' => 'control-label required'], // Add class "required" if that is mandatory field
                'choices'    => [
                    1 => __('Option 1'),
                    2 => __('Option 2'),

                ],
            ])
            ->setBreakFieldPoint('status');
    }
}
