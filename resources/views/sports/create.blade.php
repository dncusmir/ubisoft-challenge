@extends('layouts.app')

@section('content')
<div class="card">
        <div class="card-header">
            Create Sport
        </div>

        <div class="card-body">
            
            <form action="{{ route('sports.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="">
                </div>

                <button type="submit" class="btn btn-success">Save Sport</button>
            </form>
        </div>
    </div>
@endsection