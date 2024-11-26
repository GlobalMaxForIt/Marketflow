@extends('layouts.superadmin_layout')

@section('title')
    {{ translate_title(" $type Translation") }}
@endsection
@section('content')
    <form class="form-horizontal mb-2" action="{{ route('table_translation.save') }}" method="POST">
        @csrf
        <input type="hidden" id="language_code" value="{{ $language->code??'' }}">
        <input type="hidden" name="id" value="{{ $language->id }}">
        <input type="hidden" name="type" value="{{ $type??''}}">
        <h5 class="">{{ $language->name??'' }}</h5>
        <table class="mb-2 datatable restaurant_tables table table-striped table-bordered dt-responsive nowrap">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ translate_title('Key') }}</th>
                <th> {{ translate_title('Translation') }}</th>

            </tr>
            </thead>
            <tbody>
            @if (count($lang_keys) > 0)
                @php
                    $n = 1;
                @endphp
                @foreach ($lang_keys as $key => $translation)
                    <tr>
                        <td>{{ $n++ }}</td>
                        <td class="lang_key">{{ $translation->name??'' }}</td>
                        <td class="lang_value">

                            @switch($type)

                                @case('city')
                                    @php
                                        $translate_lang = \App\Models\CityTranslations::where('lang', $language->code??'')->where('city_id', $translation->city_id??'')->first();
                                    @endphp
                                    <input type="text" class="form-control value" id="input"
                                    style="width:100%" name="values[{{ $translation->city_id }}]"
                                    @if (($translate_lang) != null) value="{{ $translate_lang->name }}" @endif>

                                    @break
                                @case('product')
                                    @php
                                        $translate_lang = \App\Models\ProductTranslations::where('lang', $language->code??'')->where('product_id', $translation->product_id??'')->first();
                                    @endphp
                                    <input type="text" class="form-control value" id="input"
                                    style="width:100%" name="values[{{ $translation->product_id }}]"
                                    @if (($translate_lang) != null) value="{{ $translate_lang->name }}" @endif>

                                    @break
                                @case('product_category')
                                    @php
                                        $translate_lang = \App\Models\ProductsCategoriesTranslation::where('lang', $language->code??'')->where('products_categories_id', $translation->products_categories_id??'')->first();
                                    @endphp
                                    <input type="text" class="form-control value" id="input"
                                    style="width:100%" name="values[{{ $translation->products_categories_id }}]"
                                    @if (($translate_lang) != null) value="{{ $translate_lang->name }}" @endif>

                                    @break
                                @case('product_description')
                                    @php
                                        $translate_lang = \App\Models\ProductDescriptionTranslation::where('lang', $language->code??'')->where('product_id', $translation->product_id??'')->first();
                                    @endphp
                                    <input type="text" class="form-control value" id="input"
                                    style="width:100%" name="values[{{ $translation->product_id }}]"
                                    @if (($translate_lang) != null) value="{{ $translate_lang->name }}" @endif>

                                    @break
                                @case('product_amount')
                                    @php
                                        $translate_lang = \App\Models\ProductsAmountTranslation::where('lang', $language->code??'')->where('product_id', $translation->product_id??'')->first();
                                    @endphp
                                    <input type="text" class="form-control value" id="input"
                                    style="width:100%" name="values[{{ $translation->product_id }}]"
                                    @if (($translate_lang) != null) value="{{ $translate_lang->name }}" @endif>

                                    @break
                                @case('hall')
                                    @php
                                        $translate_lang = \App\Models\HallsTranslation::where('lang', $language->code??'')->where('hall_id', $translation->hall_id??'')->first();
                                    @endphp
                                    <input type="text" class="form-control value" id="input"
                                    style="width:100%" name="values[{{ $translation->hall_id }}]"
                                    @if (($translate_lang) != null) value="{{ $translate_lang->name }}" @endif>

                                    @break
                                @case('hall_description')
                                    @php
                                        $translate_lang = \App\Models\HallsDescriptionTranslation::where('lang', $language->code??'')->where('hall_id', $translation->hall_id??'')->first();
                                    @endphp
                                    <input type="text" class="form-control value" id="input"
                                    style="width:100%" name="values[{{ $translation->hall_id }}]"
                                    @if (($translate_lang) != null) value="{{ $translate_lang->name }}" @endif>

                                    @break
                                @case('stuff_category')
                                    @php
                                        $translate_lang = \App\Models\StuffsCategoriesTranslation::where('lang', $language->code??'')->where('stuffs_categories_id', $translation->stuffs_categories_id??'')->first();
                                    @endphp
                                    <input type="text" class="form-control value" id="input"
                                    style="width:100%" name="values[{{ $translation->stuffs_categories_id }}]"
                                    @if (($translate_lang) != null) value="{{ $translate_lang->name }}" @endif>

                                    @break
                                @default
                                    <span>Something went wrong, please try again</span>
                            @endswitch

                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <div class="row ">
            <div class="col-xl-6 col-md-6">
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="form-group mt-2 text-right">
                    <a type="button" class="btn edit_button me-2"
                            onclick="copyTranslation()">{{ translate_title('Copy Translations') }}</a>
                    <button type="submit" class="btn delete_button">{{ translate_title('Save') }}</button>
                </div>
            </div>
        </div>
    </form>

    <script src="{{ asset('js/language.js') }}"></script>

@endsection
