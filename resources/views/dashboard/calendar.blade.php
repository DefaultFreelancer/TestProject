@extends('layouts.dashboard')

@section('content')
    <calendar-component called-events="{{ $events }}"></calendar-component>
@endsection
