@extends('admin::layout.main')
@section('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@stop
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('/post') }}"><i class="fa fa-tag"></i> Category</a></li>
        <li class="active">Create Category</li>
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
                <input class="form-control" type="text" name="name"></input>
              </div>
            </div>
            <div class="panel-footer text-right">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
  @stop
