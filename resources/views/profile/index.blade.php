@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
        <profile :user="{{$user}}" />
    </div>
</div>
@endsection