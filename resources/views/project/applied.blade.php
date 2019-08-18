@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
        <project-applied :user="{{$user}}" />
    </div>
</div>
@endsection
