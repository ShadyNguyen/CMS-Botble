<?php

register_page_template([
    'default' => 'Default',
    'categories' => 'Categories',
    'cateories' => 'Categories',
    'custom-layout' => __('Custom Layout'),
]); 

register_sidebar([
    'id'          => 'second_sidebar',
    'name'        => 'Second sidebar',
    'description' => 'This is a sample sidebar for wofl theme',
]);



RvMedia::setUploadPathAndURLToPublic();

