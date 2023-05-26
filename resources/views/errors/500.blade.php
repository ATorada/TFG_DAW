@extends('layout')

@section('title', '500')

@section('content')

    <div id="error">
        <h1>500</h1>
        <h2>@lang('error.500')</h2>
        <p>@lang('error.500_2')</p>
    </div>

@endsection
