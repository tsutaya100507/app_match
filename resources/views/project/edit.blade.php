@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
      <project-edit :project="{{$project}}" :user="{{$user}}" />
    </div>
</div>
@endsection