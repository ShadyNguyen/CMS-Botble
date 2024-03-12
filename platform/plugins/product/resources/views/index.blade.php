@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
  
    <div class="settings" id="settings">

        {!! Form::open(['route' => 'settings.product']) !!}
        <x-core-setting::section :title="'Product Settings'" :description="'Setting for Product'">
            
            <x-core-setting::text-input name="setting_product_number_per_page" :label="'Sản Phẩm Mỗi Trang'" :placeholder="'....'"
                :value="setting('setting_product_number_per_page')" />

                {{-- <x-core-setting::text-input name="setting_product_coupon_in_holiday" :label="'Giảm Giá Ngày Lễ'" :placeholder="'....'"
                :value="setting('setting_product_coupon_in_holiday')" />    --}}

                <x-core-setting::select 
                name="setting_product_coupon_in_holiday"
                :label="'Giảm Giá Ngày Lễ'"
                :options="[
                    '0' => '0%',
                    '10' => '10%',
                    '20' => '20%',
                    '30' => '30%',
                    '40' => '40%',
                    '50' => '50%',
                ]"
                :value="setting('setting_product_coupon_in_holiday')" />
                
            <div class="text-start">
                <button type="submit" class="btn btn-success button-save-product-setting">
                    <i class="fa fa-save"></i> Save Settings
                </button>
            </div>
        </x-core-setting::section>

        {!! Form::close() !!}
    </div>
@endsection
