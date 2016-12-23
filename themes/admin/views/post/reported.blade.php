@extends('admin::layout.main')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kampanye Terlapor
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="ion-ios-home-outline"></i> Home</a></li>
        <li class="active">Reported</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @include('flash::message')
      <!-- Default box -->
      <div class="panel">
        <div class="panel-body">
          <div class="form-inline pull-left">
            <div class="form-group">
              <label for="from">Dari Tanggal</label>
              <input type="text" name="from" id="from" class="form-control datepicker" value="{{$param['from']}}">
            </div>
            <div class="form-group">
              <label for="till">Sampai Tanggal</label>
              <input type="text" name="till" id="till" class="form-control datepicker" value="{{$param['till']}}">
            </div>
          </div>
          <div class="pull-right">
            <button type="button" class="btn btn-primary btn-sm" id="search">Cari</button>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="box-body">
          <table id="orderTable" class="table" cellspacing="0" width="100%">
            <thead>
                <tr>
                  <th>Nama Pelapor</th>
                  <th>Email</th>
                  <th>Url Kampanye</th>
                  <th>Tanggal Laporan</th>
                  <th>Aksi</th>                    
                </tr>
            </thead>
            <tbody>
              @if(isset($campaign->data) AND count($campaign->data) > 0)
                @foreach($campaign->data as $sdata)
                <tr>
                  <td>{{$sdata->name}}</td>
                  <td>{{$sdata->email}}</td>
                  <td>{{$sdata->url}}</td>
                  <td><span class="reportedDate">{{$sdata->created_at}}</span></td>
                  <td><button class="btn btn-xs expandTable" data-id="{{$sdata->id}}" data-toggle="modal" data-target="#modalDesc">Lihat Catatan</button></td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
       <?php $w_meta = $campaign->meta;?>
       <div class="box-footer" style="{{(isset($w_meta->last) AND $w_meta->last > 1) ? '' : 'display:none'}}"">
        <div class="pull-right">
          <span>Jump to </span>
          <input id="jumpto" type="number" min="1" max="{{ $w_meta->last }}" value="{{ $w_meta->current }}">
          <div style="padding:0 15px;display:inline-block;">
            Page <span class="pagination-info">{{ $w_meta->current }} </span>
            of <span class="pagination-total">{{ $w_meta->last }}</span>
          </div>
          <div class="pagination">
            @if($w_meta->prev)
              <button data-page="{{ $w_meta->current - 1 }}" data-url="{{ $w_meta->prev }}" class="btn btn-xs btn-default btn-pagination"><span class="fa fa-angle-left"></span></button>
            @endif
            @if($w_meta->next)
              <button data-page="{{ $w_meta->current + 1 }}" data-url="{{ $w_meta->next }}" class="btn btn-xs btn-default btn-pagination"><span class="fa fa-angle-right"></span></button>
            @endif
          </div>
        </div>
        <div class="clearfix"></div>
       </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->


      <div class="modal fade" tabindex="-1" role="dialog" id="modalDesc">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </section>
    <!-- /.content -->
  @stop
  @section('js')
  <script>
    $(document).ready(function() {
      //cache selectors
      var $document = $(document);
      var $modal = $('#modalDesc');
      //timeago
      moment.locale('id');
      function re_time(){
        $document.find('.reportedDate').html(function(key,value){
          return moment(value, "YYYY-MM-DD").fromNow();
        });
      }
      re_time();
      
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        endDate: '0d'
      });
      $document.on('click','.expandTable',function(){
        var that = $(this);
        $.ajax({
          url: app.host + 'report/show/?id='+that.data('id'),
          type: "GET",
          success: function(result) {
            $modal.find('.modal-title').text('Pesan : '+result.data.email);
            $modal.find('.modal-body').text(result.data.notes);
          },
          error: function(result) {
            $('.overlay').fadeOut();
            bootbox.alert('Data yg dicari tidak ditemukan');
          }
        });
      });
      //pagination 
      //..pagination button
      $document.on('click','.btn-pagination',function(){
        var apiUrl     = $(this).data('url');
        var page       = $(this).data('page');
        var currentUrl = window.location.href;

        var newUrl = updateUrl(currentUrl,'page',page);

        if (window.history.pushState) {
          window.history.pushState({path:newUrl}, '', newUrl);
        }
        loadData(apiUrl);
      });

      $('#search').click(function(){
        var apiUrl = app.host + 'report';
        var currentUrl = window.location.href;

        var newUrl = updateUrl(currentUrl,'page',1);
            newUrl = updateUrl(newUrl,'from',$('#from').val());
            newUrl = updateUrl(newUrl,'till',$('#till').val());

        if (window.history.pushState) {
          window.history.pushState({path:newUrl}, '', newUrl);
        }
        loadData(apiUrl + window.location.search);
      });

      //..pagination callback      
      var loadData = function(apiUrl) {
        $('.overlay').show();
        $.ajax({
          url: apiUrl + '&offset={{ $param['offset'] }}',
          type: "GET",
          success: function(result) {
            if (result.meta.code === 200) {
              $('#orderTable tbody').html('');
              
              $.each(result.data, function(key, val) {
                // console.log(key, val);
                var row = $('<tr></tr>'); 
                $('<td></td>').text(val.name).appendTo(row);  
                $('<td></td>').text(val.email).appendTo(row);  
                $('<td></td>').text(val.url).appendTo(row);  
                $('<td></td>').html('<span class="reportedDate">'+val.created_at+'</span>').appendTo(row);  
                $('<td></td>').html('<button class="btn btn-xs expandTable" data-id="'+val.id+'">Lihat</button>').appendTo(row);  
                row.appendTo('#orderTable tbody');  
              });

              re_time();

              //update pagination
              if(result.meta.last > 1){
                $('.box-footer').show();
                $('.pagination-info').text(result.meta.current);

                $('.btn-pagination').remove();
                if(result.meta.prev){
                  var page = Number(result.meta.current)-1;
                  $('.pagination').append('<button data-page="'+ page +'" data-url="'+ result.meta.prev +'" class="btn btn-xs btn-default btn-pagination"><span class="fa fa-angle-left"></span></button>');
                }
                if(result.meta.next){
                  var page = Number(result.meta.current)+1;
                  $('.pagination').append('<button data-page="'+ page +'" data-url="'+ result.meta.next +'" class="btn btn-xs btn-default btn-pagination"><span class="fa fa-angle-right"></span></button>');
                }
              }
              else{
                $('.box-footer').hide();
              }

              //pagination total
              $('.pagination-total').text(result.meta.last);
              $('#jumpto').val(result.meta.current).attr('max',result.meta.last);
            } else {
              var errorMsg = '';
              if(result.meta.error){
                errorMsg += app.handleError(result.meta.errors);  
              }
              
              $('.alert')
                .removeClass('alert-danger')
                .removeClass('alert-success')
                .addClass('alert-danger')
                .slideDown()
                .html(errorMsg);
            }
            $('.overlay').hide();
          },
          error: function(result) {
            $('.overlay').fadeOut();
            bootbox.alert('Data yg dicari tidak ditemukan');
          }
        });
      };
    });

  </script>
  @stop