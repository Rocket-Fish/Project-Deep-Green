@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Projects') }}</div>

                @foreach($projects as $p)
                  <div class="form-group row">
                      <a class="col-md-1"></a>
                        <a class="col-md-10" href="{{ __(route('projects.index') . '/' . $p->id)}}">
                          {{ $p->title }}
                        </a>
                      <a class="col-md-1"></a>
                  </div>
                @endforeach

                <form method="GET" action="{{ route('projects.create') }}">
                  @csrf
                  <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                          <button type="submit" class="btn btn-primary">
                              {{ __('Add Project') }}
                          </button>
                      </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
