@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
      <direct-messages :user="{{$user}}" :rooms="{{$rooms}}" :edited_rooms="{{json_encode($edited_rooms)}}" />
    </div>
</div>
@endsection