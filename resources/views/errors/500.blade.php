@extends('layout')

@section('title', '500')

@section('content')

    <div id="error">
        <h1>500</h1>
        <h2>@lang('errors.500')</h2>
        <p>@lang('errors.500_2')</p>
    </div>

@endsection
