@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Project</div>

                <form method="POST" action="{{ route('projects.store') }}">
                  @csrf
                  @include('projects.partials.form')
                  <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                          <button type="submit" class="btn btn-primary">
                              {{ __('Create') }}
                          </button>
                      </div>
                  </div>
                </form>
                <div class = "col-md-4 offset-md-4">
                  <a class="btn btn-secondary" href="{{ __(route('projects.index'))}}">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
