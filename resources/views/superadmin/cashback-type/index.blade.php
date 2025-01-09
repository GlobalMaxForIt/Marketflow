@extends('layouts.cashier_layout')

@section('title')
     {{translate_title('Cashback type', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="right_button_create">
                    <a class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('cashback-type.store')}}">
                        <img src="{{asset('img/client_icon.png')}}" alt="" height="20px">
                        {{translate_title('New cashback type', $lang)}}
                    </a>
                </div>
                <div class="card-body overflow-auto">
                    <table id="datatable-buttons" class="restaurant_tables table table-striped table-bordered dt-responsive nowrap mt-4">
                        <thead>
                            <tr>
                                <th><h6>{{translate_title('Id', $lang)}}</h6></th>
                                <th><h6>{{translate_title('Name', $lang)}}</h6></th>
                                <th><h6>{{translate_title('Percent', $lang)}}</h6></th>
                                <th><h6>{{translate_title('Functions', $lang)}}</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cashback_type as $cashbacktype)
                                <tr>
                                    <td><h6>{{$cashbacktype['id']}}</h6></td>
                                    <td><h6>{{$cashbacktype['name']}}</h6></td>
                                    <td><h6>{{$cashbacktype['percent']}} %</h6></td>
                                    <td>
                                        <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                            <a class="edit_button btn" href="{{route('cashback-type.edit', $cashbacktype['id'])}}">
                                                <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                            </a>
                                            <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('cashback-type.destroy', $cashbacktype['id'])}}">
                                                <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="create_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New cashback type', $lang)}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('cashback-type.store', $lang)}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter name.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Percent', $lang)}}</label>
                        <input data-toggle="touchspin" type="number" name="percent" min="0" max="100" data-bts-postfix="%" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter percent.', $lang)}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between width_100_percent">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                        <button type="submit" class="btn modal_confirm">{{translate_title('Create', $lang)}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <script src="{{asset('js/datatables_style.js')}}"></script>
@endsection
