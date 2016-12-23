@extends('admin::layout.main')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Post
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Post</li>
      </ol>
    </section>

    <div class="content-filter content-header">
      <form id="filterForm" class="form" method="get">
      <div class="promo"></div>
        <div class="row">
          <div class="col-md-2">
            <label>Filter</label>
            <select name="filter" id="filter" class="form-control">
              <option {{ $param['filter'] == "all" ? "selected=selected" : "" }} value="all">All</option>
              <option {{ $param['filter'] == "pending" ? "selected=selected" : "" }} value="pending">Pending</option>
              <option {{ $param['filter'] == "publish" ? "selected=selected" : "" }} value="publish">Publish</option>
              <option {{ $param['filter'] == "draft" ? "selected=selected" : "" }} value="draft">Draft</option>
              <option {{ $param['filter'] == "suspend" ? "selected=selected" : "" }} value="suspend">Suspend</option>
            </select>
          </div>
          <div class="col-md-2">
            <label>Search By</label>
            <select name="result_type" id="result_type" class="form-control">
              <option {{ $param['result_type'] == "" ? "selected=selected" : "" }} value="">Select</option>
              <option {{ $param['result_type'] == "id" ? "selected=selected" : "" }} value="id">ID</option>
              <option {{ $param['result_type'] == "title" ? "selected=selected" : "" }} value="title">Title</option>
              <option {{ $param['result_type'] == "slug" ? "selected=selected" : "" }} value="slug">Slug</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Kerworlds</label>
            <div class="form-group">
              <input type="text" name="q" class="form-control" id="search-q" placeholder="{{ isset($param['q']) ? $param['q'] : 'Cari...' }}">
            </div><!-- /form-group -->
          </div>
          <div class="col-md-2">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-block btn-primary">Search</button>
          </div>
          <div class="col-md-2">
            <label>&nbsp;</label>
            <a href="{{ url('/post/create') }}" class="btn btn-block btn-success">Create</a>
          </div>
        </div>
      </form>
    </div>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <table id="campaignTable" class="table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            
              @if(isset($post->data) AND count($post->data) > 0)
                @foreach($post->data as $sdata)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sdata->title }}</td>
                    <td>{{ $sdata->created_at }}</td>
                    @if($sdata->status == 0)
                    <td><span class="label label-default">Pending</span></td>
                    @elseif($sdata->status == 1)
                    <td><span class="label label-success">Published</span></td>
                    @elseif($sdata->status == 2)
                    <td><span class="label label-warning">Draft</span></td>
                    @elseif($sdata->status == 3)
                    <td><span class="label label-danger">Suspended</span></td>
                    @endif
                    <td>
                      @if(session('user.0.roles.0.slug') == 'administrator')
                        @if($sdata->status != 1 AND $sdata->status != 3 )
                          <a class="btn btn-success btn-xs"  href="{{ url('post/status/'.$sdata->id.'/1' ) }}">Publish</a>
                        @endif
                        @if($sdata->status != 3)
                        <a class="btn btn-danger btn-xs"  href="{{ url('post/status/'.$sdata->id.'/3' ) }}">Suspend</a>
                        @else 

                        @endif

                      @endif
                      <a class="btn btn-warning btn-xs" target="_blank" href="{{ url('post/'.$sdata->id.'/edit' ) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
       <?php 
          function issetData(&$data){
            return isset($data) ? $data : '';
          }
        ?>
       <div class="box-footer" style="{{(isset($post->meta->last) && $post->meta->last > 1) ? '' : 'display:none' }}">
        <div class="pull-right">
          <span>Jump to </span>
          <input id="jumpto" type="number" min="1" max="{{ issetData($post->meta->last) }}" value="{{ issetData($post->meta->current) }}">
          <div style="padding:0 15px;display:inline-block;">
            Page <span class="pagination-info">{{ issetData($post->meta->current) }} </span>
            of <span class="pagination-total">{{ issetData($post->meta->last) }}</span>
          </div>
          <div class="pagination">
            @if(isset($post->meta->prev))
              <button data-page="{{ issetData($post->meta->current) - 1 }}" class="btn btn-xs btn-default btn-pagination"><span class="fa fa-angle-left"></span></button>
            @endif
            @if(isset($post->meta->next))
              <button data-page="{{ issetData($post->meta->current) + 1 }}" class="btn btn-xs btn-default btn-pagination"><span class="fa fa-angle-right"></span></button>
            @endif
          </div>
        </div>
        <div class="clearfix"></div>
       </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  @stop
  @section('js')
  <script>
    $(document).ready(function() {
      $(document).on('click','.btn-pagination',function(e){
        e.preventDefault();
        var page = $(this).attr('data-page');
        var filter = $('#statusCampaign').val();
        var currentUrl = window.location.href;
        var newUrl = updateUrl(currentUrl, 'page', page);
            newUrl = updateUrl(newUrl,'filter', filter); 
        
        window.location = newUrl;
      });

      //jump to
      $('#jumpto').keyup(function(e){
        if(e.which == 13){
          var page = $(this).val();
          var filter = $('#filter').val();
          var result_type = $('#result_type').val();
          var q = $('#search-q').val();
          var currentUrl = window.location.href;
          var newUrl = updateUrl(currentUrl, 'page', page);
              newUrl = updateUrl(newUrl,'filter', filter); 
              newUrl = updateUrl(newUrl,'result_type', result_type); 
              newUrl = updateUrl(newUrl,'q', q); 

          
            window.location = newUrl;
          
        }
      });


      $('.dropdown-menu li a').click(function(e){
        e.preventDefault();
        $('#result_type').html($(this).text() + '<span class="caret"></span>'); 
        console.log($('#result_type').text().toLowerCase());
      });

    });

  </script>
  @stop