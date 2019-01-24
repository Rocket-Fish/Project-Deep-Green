@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Project</div>

                <form method="POST" action="{{ route('projects.store') }}">
                  @csrf

                  <div class="form-group">
                    <label>Title</label>
                    <input type='text'  class="form-control" name='title' placeholder='Project Title'>
                  </div>
                  <div class="form-group">
                    <label>Showcase Image</label>
                    <input type='text'  class="form-control" name='img_url' placeholder='URL for display image'>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea  class="form-control" name='description' placeholder='Project Description'> </textarea>
                  </div>
                  <div class="form-group">
                    <label>Link display Name</label>
                    <input type='text'  class="form-control" name='link_to' placeholder='github, devpost, some other site'>
                  </div>
                  <div class="form-group">
                    <label>Link URL</label>
                    <input type='text'  class="form-control" name='link_desc' placeholder='github.com/something'>
                  </div>
                  <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                          <button type="submit" class="btn btn-primary">
                              {{ __('Create') }}
                          </button>
                      </div>
                  </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
