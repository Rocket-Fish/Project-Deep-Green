<div class="form-group">
  <label>Title</label>
  <input type='text'  class="form-control" name='title' placeholder='Project Title' @if(isset($project)) value="{{ $project->title }}" @endif>
</div>
<div class="form-group">
  <label>Showcase Image</label>
  <input type='text'  class="form-control" name='img_url' placeholder='URL for display image'   @if(isset($project)) value="{{ $project->img_url }}" @endif>
</div>
<div class="form-group">
  <label>Description</label>
  <textarea  class="form-control" name='description' placeholder='Project Description'> @if(isset($project)){{__($project->description)}}@endif </textarea>
</div>
<div class="form-group">
  <label>Link display Name</label>
  <input type='text'  class="form-control" name='link_to' placeholder='github, devpost, some other site'  @if(isset($project)) value="{{ $project->link_to }}" @endif>
</div>
<div class="form-group">
  <label>Link URL</label>
  <input type='text'  class="form-control" name='link_desc' placeholder='github.com/something'   @if(isset($project)) value="{{ $project->link_desc }}" @endif>
</div>
