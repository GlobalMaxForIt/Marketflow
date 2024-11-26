@extends('layouts.superadmin_layout')

@section('title')
{{ translate_title("$type translation", $lang) }}
@endsection
@section('content')
    <table class="table mt-2" style="text-align:center !important">
        <thead >
        <tr>
            <th scope="row">№</th>
            <td>{{ translate_title('Language', $lang) }}</td>
            <td>{{ translate_title('Code', $lang) }}</td>
            <td>{{ translate_title('Action', $lang) }}</td>
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

