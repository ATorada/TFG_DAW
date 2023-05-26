@extends('layout')

@section('title', '404')

@section('content')

    <div id="error">
        <h1>404</h1>
        <h2>@lang('errors.404')</h2>
        <p>@lang('errors.404_2')</p>
    </div>

@endsection
