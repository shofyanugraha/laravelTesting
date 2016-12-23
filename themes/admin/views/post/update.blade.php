@extends('admin::layout.main')
@section('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@stop
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Post - {{ $post->data->title }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('/post') }}"><i class="fa fa-file"></i> Post</a></li>
        <li class="active">Update Post - {{ $post->data->title }}</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <form method="post" enctype="multipart/form-data">
       {{ csrf_field() }}
       <input type="hidden" name="type" value="{{ $post->data->type }}">
      <div class="row">
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="form-group">
                <label>Title</label>
                <input class="form-control" type="text" name="title" value="{{ $post->data->title }}"></input>
              </div>
              @if($post->data->type == 'image')
              <div class="form-group type type-image">
                <label>Image</label>
                <input class="form-control" type="file" name="image"></input>
              </div>
              @else 
              <div class="form-group type type-video">
                <label>URL</label>
                <input class="form-control" type="url" name="url" value="{{ $post->data->content->url }}"></input>
              </div>
              @endif
              <div class="form-group">
                <label>Description</label>
                <textarea name="article" id="summernote">{{ $post->data->article }}</textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel">
            <div class="panel-body">
              <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control">
                  @foreach($category->data as $cat) 
                  @if($post->data->category->id == $cat->id)
                  <option selected="selected" value="{{$cat->id}}">{{ $cat->name }}</option>
                  @else 
                  <option value="{{$cat->id}}">{{ $cat->name }}</option>
                  @endif
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