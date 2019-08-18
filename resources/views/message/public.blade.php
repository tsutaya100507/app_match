@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
        <public-messages :user="{{$user}}" />
    </div>
</div>
@endsection