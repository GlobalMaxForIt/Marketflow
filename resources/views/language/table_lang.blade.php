@extends('layouts.superadmin_layout')

@section('title')
{{ translate_title("$type translation", $lang) }}
@endsection
@section('content')
    <table class="table mt-2" style="text-align:center !important">
        <thead >
        <tr>
            <th scope="row">№</th>
            <td><h6>{{ translate_title('Language', $lang) }}</h6></td>
            <td><h6>{{ translate_title('Code', $lang) }}</h6></td>
            <td><h6>{{ translate_title('Action', $lang) }}</h6></td>
        </tr>
        </thead>
        <tbody class="text-align:center !important">
        @empty(!$languages)
            @php
                $i = 1;
            @endphp

            @foreach ($languages as $value)
                <tr>
                    <th scope="row">{{ $i++ }}</h6></th>
                    <td> {{ $value->name??'' }}</h6></td>
                    <td><h6>{{ $value->code??'' }}</h6></td>
                    <td>
                        <a href="{{ route('table.tableShow', ['language_id' => $value->id, 'type' => $type]) }}"
                           title="{{ translate_title('Translation', $lang) }}">
                            <button type="button" class="btn edit_button"><i class="fa fa-language"></i></button>
                        </a>
                    </td>
                </tr>
            @endforeach

        @endempty
        </tbody>
    </table>

@endsection

