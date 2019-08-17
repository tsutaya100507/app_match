@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
        <profile-edit :user="{{$user}}" />
    </div>
</div>
@endsection