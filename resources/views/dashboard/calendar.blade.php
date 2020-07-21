@extends('layouts.dashboard')

@section('content')
    <calendar-component calledEvents="{{ $events }}"></calendar-component>
@endsection
