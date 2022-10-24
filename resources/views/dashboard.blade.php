@extends('layouts.main')
@section('content')
    <div class="main">
        @if (auth()->user()->is_admin == true)
            @section('class', 'body')
            @include('admin.index')
        @else
            @include('customer.index')
        @endif
    </div>
@endsection
