@extends('admin::layout.main')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="ion-ios-home-outline"></i> Home</a></li>
        <li class="active">Category</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <p class="text-right">
        <a class="btn btn-success" href="{{url('/category/create')}}">Create</a>
      </p>
      <div class="box">
        <div class="box-body">
          <table id="campaignTable" class="table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            
              @if(isset($category->data) AND count($category->data) > 0)
                @foreach($category->data as $sdata)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sdata->name }}</td>
                    <td>
                      <a class="btn btn-warning btn-xs" target="_blank" href="{{ url('category/'.$sdata->id.'/edit' ) }}">Edit</a>
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
       <div class="box-footer" style="{{(isset($category->meta->last) && $category->meta->last > 1) ? '' : 'display:none' }}">
        <div class="pull-right">
          <span>Jump to </span>
          <input id="jumpto" type="number" min="1" max="{{ issetData($category->meta->last) }}" value="{{ issetData($category->meta->current) }}">
          <div style="padding:0 15px;display:inline-block;">
            Page <span class="pagination-info">{{ issetData($category->meta->current) }} </span>
            of <span class="pagination-total">{{ issetData($category->meta->last) }}</span>
          </div>
          <div class="pagination">
            @if(isset($category->meta->prev))
              <button data-page="{{ issetData($category->meta->current) - 1 }}" class="btn btn-xs btn-default btn-pagination"><span class="fa fa-angle-left"></span></button>
            @endif
            @if(isset($category->meta->next))
              <button data-page="{{ issetData($category->meta->current) + 1 }}" class="btn btn-xs btn-default btn-pagination"><span class="fa fa-angle-right"></span></button>
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