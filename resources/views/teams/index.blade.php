@extends('layouts.app')

@section('content')
<div class="card">
        <div class="card-header">
            All Teams
        </div>

        <div class="card-body"> 
        @if($teams->count() > 0)
            @foreach ($teams as $team)                                    
                <div class="pb-4 mb-4 border-bottom border-gray">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>
                                {{ $team->name }}
                            </strong>
                        </div>
                        <div>
                            <span style="border-bottom:1px solid">Sport: {{ $team->sport->name }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3 class="text-center">No teams yet</h3>
        @endif
        </div>
</div>
@endsection