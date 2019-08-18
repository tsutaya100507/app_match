@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
        <project-create :user="{{$user}}" />
    </div>
</div>
@endsection