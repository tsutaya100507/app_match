@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
    <dm-room :room="{{$room}}" :user="{{$user}}" />
    </div>
</div>
@endsection