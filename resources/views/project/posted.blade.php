@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
        <project-posted :user="{{$user}}" />
    </div>
</div>
@endsection
