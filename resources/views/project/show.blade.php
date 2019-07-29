@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
      {{$room}}
      {{$project[0]}}
      {{$user}}
    <project-detail :project="{{$project[0]}}" :current_user="{{$user}}" :room="{{$room}}" />
    </div>
</div>
@endsection