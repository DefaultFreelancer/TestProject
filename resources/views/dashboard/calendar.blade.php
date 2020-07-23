@extends('layouts.dashboard')

@section('content')
    @csrf
    <calendar-component called-events="{{ $events }}" events-category="{{ $categories }}"></calendar-component>
@endsection
