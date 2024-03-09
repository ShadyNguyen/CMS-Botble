@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="settings" id="settings">
        {!! Form::open(['route' => 'settings.product']) !!}
        <x-core-setting::section 
        :title="'Product Settings'" 
        :description="'Setting for Product'">


            <x-core-setting::text-input name="setting_product_genaral" :label="'Test Save Setting'" :placeholder="'Try it!!'"
                :value="setting('setting_product_genaral')" />



            <div class="text-start">
                <button type="submit" class="btn btn-success button-save-product-setting">
                    <i class="fa fa-save"></i> Save Settings
                </button>
            </div>
        </x-core-setting::section>

        {!! Form::close() !!}

    </div>
@endsection
