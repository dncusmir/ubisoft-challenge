@extends('layouts.app')

@section('content')
        <div class="d-flex align-items-center p-3 my-3 text-black-50 bg-warning rounded box-shadow">
            {{ $team->name }}
        </div>
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0">Sport: {{ $team->sport }}</h6>
        </div>
@endsection