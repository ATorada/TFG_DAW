@extends('layout')

@section('title', '404')

@section('content')

    <div id="error">
        <h1>404</h1>
        <h2>@lang('error.404')</h2>
        <p>@lang('error.404_2')</p>
    </div>

@endsection
