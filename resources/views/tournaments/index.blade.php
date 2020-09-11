@extends('layouts.app')

@section('content')
<div class="card">
    @if ($tournaments->count() == 0)
        <div class="card-header">
            No Tournaments
        </div>
    @else
        <div class="card-header">
            All Tournaments
        </div>
        <div class="card-body">
        @foreach ($tournaments as $tournament)
            <div class="pb-4 mb-4 border-bottom border-gray">                                
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>
                            <a href="{{ route('tournaments.show', $tournament->id) }}">{{ $tournament->name }}</a>
                        </strong>
                    </div>
                    <div>
                        <span style="border-bottom:1px solid">Games: {{ count($tournament->games) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>
@endsection