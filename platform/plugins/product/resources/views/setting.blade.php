<x-core-setting::section
    :title="'Product'"
    :description="'Setting Product'"
>
    <x-core-setting::checkbox
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
    />

    <p>Test</p>
</x-core-setting::section>
{{-- <x-core-setting::section>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('settings.save') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('plugins/product::settings.title') }}</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($sections as $section)
                            <div class="form-group">
                                <label for="{{ $section['title'] }}">{{ $section['title'] }}</label>
                                @foreach ($section['fields'] as $field)
                                    <div class="form-group">
                                        <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                                        @switch($field['type'])
                                            @case('text')
                                                <input type="text" class="form-control" name="{{ $field['name'] }}" value="{{ get_setting($field['name']) }}">
                                                @break
                                            @case('textarea')
                                                <textarea class="form-control" name="{{ $field['name'] }}">{{ get_setting($field['name']) }}</textarea>
                                                @break
                                            @case('checkbox')
                                                <input type="checkbox" class="form-control" name="{{ $field['name'] }}" value="1" @if (get_setting($field['name']) == 1) checked @endif>
                                                @break
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('core/base::forms.save') }}</button>
                    </div>
                 </div>
            </form>
        </div>
    </div>

</x-core-setting::section> --}}
