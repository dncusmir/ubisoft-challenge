@extends('layouts.app')

@section('content')
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0">All Sports</h6>

        @if($sports->count() > 0)
            @foreach ($sports as $sport)
                <div class="media text-muted pt-3">
                    <p class="media-body ml-4 pl-2 pb-3 mb-0 lh-125 border-bottom border-gray">
                    <strong>
                            <a href="{{ route('sports.show', $sport->id) }}">{{ $sport->name }}</a>
                        </strong>
                    </p>
                </div>
            @endforeach
        @else
            <h3 class="text-center">No sports yet</h3>
        @endif
        </div>
@endsection