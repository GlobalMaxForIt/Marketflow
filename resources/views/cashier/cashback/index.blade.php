@extends('layouts.cashier_layout')

@section('title')
     {{translate_title('Clients', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="right_button_create">
                    <a class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('cashback.store')}}">
                        <img src="{{asset('img/client_icon.png')}}" alt="" height="20px">
                        {{translate_title('New cashback', $lang)}}
                    </a>
                </div>
                <div class="card-body overflow-auto">
                    <table id="datatable-buttons" class="restaurant_tables table table-striped table-bordered dt-responsive nowrap mt-4">
                        <thead>
                        <tr>
                            <th><h6>{{translate_title('Id', $lang)}}</h6></th>
                            <th><h6>{{translate_title('Client', $lang)}}</h6></th>
                            <th><h6>{{translate_title('Cashback type', $lang)}}</h6></th>
                            <th><h6>{{translate_title('All sum', $lang)}}</h6></th>
                            <th><h6>{{translate_title('Taken sum', $lang)}}</h6></th>
                            <th><h6>{{translate_title('Left sum', $lang)}}</h6></th>
                            <th><h6>{{translate_title('Client expenses', $lang)}}</h6></th>
                            <th><h6>{{translate_title('Functions', $lang)}}</h6></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_cashbacks as $cashback)
                            <tr>
                                <td><h6>{{$cashback['id']}}</h6></td>
                                <td><h6>{{$cashback['client']}}</h6></td>
                                <td><h6>{{$cashback['cashback_type']}}</h6></td>
                                <td><h6>{{$cashback['all_sum']}}</h6></td>
                                <td><h6>{{$cashback['taken_sum']}}</h6></td>
                                <td><h6>{{$cashback['left_sum']}}</h6></td>
                                <td><h6>{{$cashback['client_expenses']}}</h6></td>
                                <td>
                                    <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                        <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('cashback.destroy', $cashback['id'])}}">
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
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New cashback', $lang)}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('cashback.store', $lang)}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative mb-3">
                        <div class="form-floating">
                            <select name="client_id" class="form-control" id="client_id" required>
                                @if(empty($clients_for_discount))
                                    <option value="">{{translate_title('Client is not found', $lang)}}</option>
                                @endif
                                @foreach($clients_for_discount as $client_for_discount)
                                    <option value="{{$client_for_discount['id']}}">{{$client_for_discount['name'].' '.$client_for_discount['surname']}}</option>
                                @endforeach
                            </select>
                            <label class="form-label">{{translate_title('Select client', $lang)}}</label>
                            <div class="invalid-tooltip">
                                {{translate_title('Please select client.', $lang)}}
                            </div>
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <div class="form-floating">
                            <select name="cashback_type_id" class="form-control" id="cashback_type_id">
                                @foreach($cashback_types as $cashback_type)
                                    <option value="{{$cashback_type->id}}">{{$cashback_type->name.' '.$cashback_type->percent.' %'}}</option>
                                @endforeach
                            </select>
                            <label class="form-label">{{translate_title('Select client', $lang)}}</label>
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
