@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$project->title}}</div>
                <div class="card-body">
                  <label>Image URL:</label>
                  <p class = "card-text"> {{$project->img_url}}</p>
                  <label>Description:</label>
                  <p class = "card-text"> {{$project->description}}</p>
                  <label>Link To:</label>
                  <p class = "card-text"> {{$project->link_desc}}</p>
                  <label>Link URL:</label>
                  <p class = "card-text"> {{$project->link_to}}</p>
                  <div class = "col-md-4 offset-md-4">
                    <a class="btn btn-primary" href="{{ __(route('projects.index') . '/' . $project->id . '/edit')}}">Modify</a>
                  </div>
                  <div class = "col-md-4 offset-md-4">
                    <a class="btn btn-secondary" href="{{ __(route('projects.index'))}}">Back</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
