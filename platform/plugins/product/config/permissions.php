<?php

return [
    [
        'name' => 'Products',
        'flag' => 'product.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'product.create',
        'parent_flag' => 'product.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'product.edit',
        'parent_flag' => 'product.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'product.destroy',
        'parent_flag' => 'product.index',
    ],
    [
        'name' => 'Product categories',
        'flag' => 'product-categories.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'product-categories.create',
        'parent_flag' => 'product-categories.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'product-categories.edit',
        'parent_flag' => 'product-categories.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'product-categories.destroy',
        'parent_flag' => 'product-categories.index',
    ],
    [
        'name' => 'Product items',
        'flag' => 'product-items.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'product-items.create',
        'parent_flag' => 'product-items.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'product-items.edit',
        'parent_flag' => 'product-items.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'product-items.destroy',
        'parent_flag' => 'product-items.index',
    ],
];
