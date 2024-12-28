@extends('layouts.cashier_layout')

@section('title')
    {{-- Your page title --}}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mt-0 header-title">{{translate_title('Coupon lists', $lang)}}</h4>
            <div class="dropdown float-end">
                <a class="form_functions btn btn-success mb-2" href="{{route('gift-cards.create')}}">{{translate_title('Create', $lang)}}</a>
            </div>
{{--            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">--}}
            <table class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate_title('Name', $lang)}}</th>
                        <th>{{translate_title('Coupon value', $lang)}}</th>
                        <th>{{translate_title('Minimum price', $lang)}}</th>
                        <th>{{translate_title('Orders\' quantity or number', $lang)}}</th>
                        <th class="text-center">{{translate_title('Functions', $lang)}}</th>
                    </tr>
                </thead>
                <tbody class="table_body">
                    @php
                        $i = 0
                    @endphp
                    @foreach($gift_cards as $gift_card)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>
                                <a class="show_page" href="{{route('gift-cards.show', $gift_card->id)}}">
                                    {{$i}}
                                </a>
                            </td>
                            <td>
                                <a class="show_page" href="{{route('gift-cards.show', $gift_card->id)}}">
                                    @if($gift_card->name)
                                        {{$gift_card->name}}
                                    @else
                                        <div class="no_text"></div>
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a class="show_page" href="{{route('gift-cards.show', $gift_card->id)}}">
                                    @if ($gift_card->price != null)
                                       {{$gift_card->price}} {{translate_title(' sum', $lang)}}
                                    @elseif($gift_card->percent != null)
                                       {{$gift_card->percent}} {{translate_title(' %', $lang)}}
                                    @else
                                        <div class="no_text"></div>
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a class="show_page" href="{{route('gift-cards.show', $gift_card->id)}}">
                                    @if($gift_card->min_price)
                                        {{$gift_card->min_price}}
                                    @else
                                        <div class="no_text"></div>
                                    @endif
                                </a>
                            </td>
                            @if($gift_card->order_quantity)
                                <td>
                                    <a class="show_page" href="{{route('gift-cards.show', $gift_card->id)}}">
                                        {{$gift_card->order_quantity}} {{translate_title('quantity', $lang)}}
                                    </a>
                                </td>
                            @elseif($gift_card->order_number)
                                <td>
                                    <a class="show_page" href="{{route('gift-cards.show', $gift_card->id)}}">
                                        {{$gift_card->order_number}} {{translate_title('number', $lang)}}
                                    </a>
                                </td>
                            @else
                                <a class="show_page" href="{{route('gift-cards.show', $gift_card->id)}}">
                                    <div class="no_text"></div>
                                </a>
                            @endif
                            <td class="function_column">
                                <div class="d-flex justify-content-center">
                                    <a class="form_functions btn btn-info" href="{{route('gift-cards.edit', $gift_card->id)}}"><i class="fe-edit-2"></i></a>
                                    <button type="button" class="btn btn-danger delete-datas btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#warning-alert-modal" data-url="{{route('gift-cards.destroy', $gift_card->id)}}"><i class="fe-trash-2"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
