<x-core-setting::section
    :title="'Product'"
    :description="'Settings for Product'"
>
    {{-- <x-core-setting::checkbox
        name="blog_post_schema_enabled"
        :label="trans('plugins/blog::base.settings.enable_blog_post_schema')"
        :checked="setting('blog_post_schema_enabled', true)"
        :helper-text="trans('plugins/blog::base.settings.enable_blog_post_schema_description')"
    />

    <x-core-setting::select
        name="blog_post_schema_type"
        :label="trans('plugins/blog::base.settings.schema_type')"
        :options="[
            'NewsArticle' => 'NewsArticle',
            'News' => 'News',
            'Article' => 'Article',
            'BlogPosting' => 'BlogPosting'
        ]"
        :value="setting('blog_post_schema_type', 'NewsArticle')"
    /> --}}

    <x-core-setting::text-input 
        name="product_save_data"
        :label="'Test Save'"
        :placeholder="'try it!!'"
        :value="setting('product_save_data')"
        />

    tesst
</x-core-setting::section>
