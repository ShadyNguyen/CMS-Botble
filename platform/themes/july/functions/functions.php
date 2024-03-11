<?php

register_page_template([
    'default' => 'Default',
]);

register_sidebar([
    'id'          => 'second_sidebar',
    'name'        => 'Second sidebar',
    'description' => 'This is a sample sidebar for july theme',
]);

RvMedia::setUploadPathAndURLToPublic();

add_filter(BASE_FILTER_BEFORE_RENDER_FORM, function ($form, $data)
{
    if (get_class($data) == \Dcore\Blog\Models\Post::class) {
    
        $test = \MetaBox::getMetaData($data, 'test', true);
    
        $form
            ->add('test', 'text', [
                'label'      => __('Test Field'),
                'label_attr' => ['class' => 'control-label'],
                'value'      => $test,
                'attr'       => [
                    'placeholder' => __('Test'),
                ],
            ]);

    }
    
    return $form;
}, 120, 3);

add_action(BASE_ACTION_AFTER_CREATE_CONTENT, 'save_addition_fields', 120, 3);
add_action(BASE_ACTION_AFTER_UPDATE_CONTENT, 'save_addition_fields', 120, 3);

/**
 * @param string $screen
 * @param Request $request
 * @param Model $data
 */
function save_addition_fields($screen, $request, $data)
{
    if (get_class($data) == \Dcore\Blog\Models\Post::class) {
        MetaBox::saveMetaBoxData($data, 'test', $request->input('test'));
    }
}
