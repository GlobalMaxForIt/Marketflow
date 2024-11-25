@extends('layouts.superadmin_layout')

@section('title')
    {{ translate_title("Language translate") }}
@endsection
@section('content')
    <div id="loader"></div>
    <div class="main-content-section d-none" id="myDiv">
        <div class="order-section">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item ms-2 mb-2" role="presentation">
                    <a class="nav-link active" id="language-tab" data-bs-toggle="tab" href="#language" role="tab" aria-controls="language" aria-selected="true">{{translate_title('Translate')}}</a>
                </li>
                <li class="nav-item ms-2 mb-2" role="presentation">
                    <a class="nav-link" id="table-translate-tab" data-bs-toggle="tab" href="#table-translate" role="tab" aria-controls="table-translate" aria-selected="false">{{translate_title('Table translate')}}</a>
                </li>
            </ul>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="language" role="tabpanel" aria-labelledby="language-tab">
                            <form class="parsley-examples" action="{{ route('env_key_update.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <h2>{{ translate_title('Default language') }}</h2>
                                    </div>
                                    <div class="col-md-2 ">
                                        <div class=" mt-2">
                                            <input type="hidden" name="types[]" value="DEFAULT_LANGUAGE">
                                            <select  class="form-select"    id="country" name="DEFAULT_LANGUAGE">
                                                @foreach ($languages as $key => $language)
                                                    <option value="{{ $language->code??'' }}" <?php if (env('DEFAULT_LANGUAGE') == $language->code??'') {
                                                        echo 'selected';
                                                    } ?>>
                                                        {{ $language->name??'' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a type="submit" class="btn edit_button mt-2">{{ translate_title('Save') }}</a>
                                    </div>
                                </div>

                            </form>
                            <table class="table mt-2" style="text-align:center !important">
                                <thead >
                                    <tr>
                                        <th scope="row">№</th>
                                        <td>{{ translate_title('Language') }}</td>
                                        <td>{{ translate_title('Code') }}</td>
                                        <td>{{ translate_title('Action') }}</td>
                                    </tr>
                                </thead>
                                <tbody class="text-align:center !important">
                                @empty(!$languages)
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($languages as $value)
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td> {{ $value->name??'' }}</td>
                                            <td>{{ $value->code??'' }}</td>
                                            <td>
                                                <a href="{{ route('language.show', $value->id) }}"
                                                   title="{{ translate_title('Translation') }}"  >
                                                    <a type="button" class="btn edit_button waves-effect waves-light">
                                                        <i class="fa fa-language"></i>
                                                    </a>
                                                </a>
                                                <a href="{{ route('language.edit', encrypt($value->id)) }}">
                                                    <a type="button" class="btn edit_button waves-effect waves-light">
                                                        <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                                    </a>
                                                </a>
                                                @if ($value->code != 'en')
                                                    <a type="button" class="btn delete_button" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{ route('language.destroy', $language->id) }}">
                                                        <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endempty
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="table-translate" role="tabpanel" aria-labelledby="table-translate-tab">
                            <div class="justify-content-center">
                                <ul class="translation_content">
                                    <li class="translation_list">
                                        <a href="{{ route('table.show', 'city') }}"><div class="translation_menu">{{translate_title('City translate')}}</div></a>
                                    </li>
                                    <li class="translation_list">
                                        <a href="{{ route('table.show', 'product') }}"><div class="translation_menu">{{translate_title('Product translate')}}</div></a>
                                    </li>
                                    <li class="translation_list">
                                        <a href="{{ route('table.show', 'product_category') }}"><div class="translation_menu">{{translate_title('Product category translate')}}</div></a>
                                    </li>
                                    <li class="translation_list">
                                        <a href="{{ route('table.show', 'product_description') }}"><div class="translation_menu">{{translate_title('Product description translate')}}</div></a>
                                    </li>
                                    <li class="translation_list">
                                        <a href="{{ route('table.show', 'product_amount') }}"><div class="translation_menu">{{translate_title('Product amount translate')}}</div></a>
                                    </li>
                                    <li class="translation_list">
                                        <a href="{{ route('table.show', 'hall') }}"><div class="translation_menu">{{translate_title('Hall translate')}}</div></a>
                                    </li>
                                    <li class="translation_list">
                                        <a href="{{ route('table.show', 'hall_description') }}"><div class="translation_menu">{{translate_title('Hall description translate')}}</div></a>
                                    </li>
                                    <li class="translation_list">
                                        <a href="{{ route('table.show', 'stuff_category') }}"><div class="translation_menu">{{translate_title('Stuff category translate')}}</div></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/language.js') }}"></script>
@endsection

