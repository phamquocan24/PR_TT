@extends('admin::layout')

@section('title', 'Dashboard')

@section('content_header')
    <h3 class="pull-left">Dashboard</h3>
@endsection

@section('content')
    <div class="grid">
        <div class="row">
           <div class="col">
               <h5>Main Content Dashboard</h5>
           </div>
        </div>
    </div>
@endsection

@push('globals')
    @vite([
        "modules/Admin/Resources/assets/sass/dashboard.scss",
        "modules/Admin/Resources/assets/js/dashboard.js",
    ])
@endpush
