@extends('layouts.app')

@section('content')
    <tournament-show :id="{{$tournamentId}}" :user="{{$userId}}"></tournament-show>
@endsection