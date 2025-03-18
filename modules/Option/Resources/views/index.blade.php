@extends('option::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('option.name') !!}</p>
@endsection
