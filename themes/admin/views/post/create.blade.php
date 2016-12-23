@extends('admin::layout.main')
@section('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@stop
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Post
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('/post') }}"><i class="fa fa-file"></i> Post</a></li>
        <li class="active">Create</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <form method="post" enctype="multipart/form-data">
       {{ csrf_field() }}
      <div class="row">
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="form-group">
                <label>Title</label>
                <input class="form-control" type="text" name="title"></input>
              </div>
              <div class="form-group type type-image" style="display: block;">
                <label>Image</label>
                <input class="form-control" type="file" name="image"></input>
              </div>
              <div class="form-group type type-video"  style="display: none;">
                <label>URL</label>
                <input class="form-control" type="url" name="url"></input>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="article" id="summernote"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel">
            <div class="panel-body">
              <div class="form-group">
                <label>Post Type</label>
                <select name="type" class="form-control" id="type">
                  <option value="image">Image</option>
                  <option value="video">Video</option>
                </select>
              </div>
              <hr>
              <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control">
                  @foreach($category->data as $cat) 
                  <option value="{{$cat->id}}">{{ $cat->name }}</option>
                  @endforeach
                </select>
              </div>
              <hr>
              <button type="submit" class="btn btn-block btn-primary">Save</button>
            </div>
          </div>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  @stop
  @section('js')
  <script>
    $(document).ready(function() {
      $('#type').change(function() {
        console.log($(this).val());
        $('.type').hide();
        $('.type input').val('');
        var inputClass = $(this).val();
         $('.type-' + inputClass).show();
        
      });
      $('#summernote').summernote({
         toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]
      });

    });

  </script>
  @stop