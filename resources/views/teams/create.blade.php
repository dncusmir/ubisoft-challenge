@extends('layouts.app')

@section('content')
<div class="card">
        <div class="card-header">
            Create Team
        </div>

        <div class="card-body">
            
            <form action="{{ route('teams.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="">
                </div>

                <div class="form-group">
                    <label for="sport">Assigned Sport</label>
                    <select class="form-control sport-selector" id="sport_id" name="sport_id">
                        @foreach($sports as $sport)
                        <option value="{{ $sport->id }}">
                            {{ $sport->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Save Team</button>
            </form>
        </div>
    </div>
@endsection