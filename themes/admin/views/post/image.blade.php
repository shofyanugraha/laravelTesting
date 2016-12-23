@extends('admin::layout.main')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Campaign
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="ion-ios-home-outline"></i> Home</a></li>
        <li class="active">Campaign</li>
      </ol>
    </section>

    <div class="content-filter">
      <form id="filter" class="form">
      <div class="promo"></div>
        <div class="row">
          <div class="col-md-2">
            <label>Status</label>
            <select name="statusCampaign" id="statusCampaign" class="form-control">
              <option {{ $param['filter'] == "11" ? "selected=selected" : "" }} value="11">Diterima</option>
              <option {{ $param['filter'] == "2" ? "selected=selected" : "" }} value="2">Belum Diperiksa</option>
              <option {{ $param['filter'] == "3" ? "selected=selected" : "" }} value="3">Tidak Diterima</option>
            </select>
          </div>
          <div class="col-md-2">
            <label>Mulai Tanggal</label>
            <input type="text" class="form-control" id="started" value="{{ $param['started'] ? date('Y-m-d', strtotime($param['started'])) : '' }}">
          </div>
          <div class="col-md-2">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-block btn-primary">Cari</button>
          </div>
        </div>
      </form>
    </div>
    <!-- Main content -->
    <section class="content">
      @include('flash::message')
      
          @if(isset($campaign->data) AND count($campaign->data) > 0)
              <div class="row" id="campaignTable">

                @foreach($campaign->data as $sdata)
                  
                <div class="col-md-4" id="campaign{{ $sdata->id}}">
                  <div class="box">
                    <div class="box-body text-center">
                      <img src="{{ $sdata->campaign_detail[0]->thumb_front_image }}" width="45%">
                      <img src="{{ $sdata->campaign_detail[0]->thumb_back_image }}"  width="45%">
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                      <h5><a href="https://blazbluz.com/{{ $sdata->slug }}">{{ $sdata->title }}</a></h5>
                      <a class="btn btn-primary btn-xs btnApprove" data-status="1" data-campaign="{{ $sdata->id  }}">Terima</a>
                      <a class="btn btn-danger btn-xs btnDenied" data-status="3" data-campaign="{{ $sdata->id }}">Tolak</a>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              @endif
        <ul class="pagination">
          @if(isset($campaign->meta->last) AND $campaign->meta->last  > 1)
            @for($i=1; $i <= $campaign->meta->last; $i ++)
            <li class="{{ $campaign->meta->current == $i ? 'active' : ''}}">
              <a href="#" data-url="{{ $i }}">{{ $i }}</a>
            </li>
            @endfor
            @endif
          </ul>

    </section>
    <!-- /.content -->
  @stop
  @section('js')
  <script>
    $(document).ready(function() {
      $(".select2").select2();

        var FromEndDate = new Date();
        
        $('#started').datepicker({
          format: 'yyyy-mm-dd',
          endDate: FromEndDate,
        });

        $('#ended').datepicker({
          format: 'yyyy-mm-dd',
          endDate: FromEndDate,
        });
      

        $('#filter').submit(function(e) {
          e.preventDefault();
          
          var statusOrder = $('#statusCampaign').val();
          var started = $('#started').val();

          
        
          var currentUrl = window.location.href;
          // var page = getParameter('page', link);
          var newUrl = updateUrl(currentUrl,'filter',statusOrder);
          
            newUrl = updateUrl(newUrl,'started', started);  
          
          
          newUrl = removeParam('page', newUrl);
          
          if (window.history.pushState) {
            window.history.pushState({path:newUrl}, '', newUrl);
          }

          var apiUrl = app.host + 'campaign/search' + window.location.search;
          apiUrl = updateUrl(apiUrl, 'page', 1);
          loadData(apiUrl); 
        });
      $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var statusOrder = $('#statusCampaign').val();
        var page = $(this).attr('data-url');
        var currentUrl = window.location.href;
        var started = $('#started').val();

        var newUrl = updateUrl(currentUrl,'page',page);
          newUrl = updateUrl(newUrl, 'started', started);
          newUrl = updateUrl(newUrl,'filter',statusOrder);
        if (window.history.pushState) {
          window.history.pushState({path:newUrl}, '', newUrl);
        }
        var apiUrl = app.host + 'campaign/search' + window.location.search;
        apiUrl = updateUrl(apiUrl, 'page', page);
        // apiUrl = updateUrl(apiUrl, 'user_id', {{ session()->get('user.id') }});
        loadData(apiUrl);
      });

      $('.btnApprove').click(function(e) {
        e.preventDefault();
        var fd = new FormData;
        var that = $(this);
        fd.append('campaign_id', that.attr('data-campaign'));
        fd.append('status', that.attr('data-status'));

        $(this).attr('disabled','disabled');
        $(this).prepend('<i class="fa fa-spinner fa-spin"></i> ');

        $.ajax({
          url: app.host + 'campaign/status',
          type: "POST",
          processData: false,
          contentType: false,
          data: fd,
          success: function(result) {
            if (result.meta.code === 200) {
              bootbox.alert('Campaign telah diterima', function() {
                $('#campaign'+ that.attr('data-campaign')).remove();
              });
              
            } else {
              alert(2);
            }
          },
          error: function(result) {
            bootbox.alert('Campaign gagal diterima');
          }
        });
      });

      $('.btnDenied').click(function(e) {
        e.preventDefault();
        var fd = new FormData;
        var that = $(this);
        fd.append('campaign_id', that.attr('data-campaign'));
        fd.append('status', that.attr('data-status'));

        $(this).attr('disabled','disabled');
        $(this).prepend('<i class="fa fa-spinner fa-spin"></i> ');

        $.ajax({
          url: app.host + 'campaign/status',
          type: "POST",
          processData: false,
          contentType: false,
          data: fd,
          success: function(result) {
            if (result.meta.code === 200) {
              bootbox.alert('Campaign telah ditolak', function() {
                $('#campaign'+ that.attr('data-campaign')).remove();
              });
              
            } else {
              alert(2);
            }
          },
          error: function(result) {
            bootbox.alert('Campaign gagal ditolak');
          }
        });
      });


      var loadData = function(apiUrl) {
        $('.overlay').show();
        $.ajax({
          url: apiUrl + '&offset={{ $param['offset'] }}',
          type: "GET",
          success: function(result) {
            if (result.meta.code === 200) {
              $('#campaignTable').html('');
              
              $.each(result.data, function(key, val) {
                // console.log(key, val);
                var row = $('<div></div>').addClass('col-md-4').attr('id', 'campaign'+val.id);
                var box = $('<div></div>').addClass('box').appendTo(row);
                var boxBody = $('<div></div>').addClass('box-body text-center').appendTo(box);
                var imgFront  = $('<img/>').attr('width', '45%').attr('src', val.campaign_detail[0].thumb_front_image).appendTo(boxBody);
                var imgBack  = $('<img/>').attr('width', '45%').attr('src', val.campaign_detail[0].thumb_back_image).appendTo(boxBody);
                var boxFooter = $('<div></div>').addClass('box-footer text-center').appendTo(box);
                var link = $('<a></a>').attr('href', "https://blazbluz.com/"+val.slug).html(val.title);
                var title = $('<h5></h5>').html(link).appendTo(boxFooter);
                var linkApprove = $('<a></a>').html('Terima').addClass('btn btnApprove btn-primary btn-xs').attr('data-campaign', val.id).attr('status', 1).appendTo(boxFooter);
                var linkDenied = $('<a></a>').html('Tolak').addClass('btn btnDenied btn-danger btn-xs').attr('data-campaign', val.id).attr('status', 3).appendTo(boxFooter);
                
                row.appendTo('#campaignTable');
              });

              $('.pagination li').remove();
              var paginationHolder = $('.pagination');
              if(result.meta.last > 1) {
                for(var i = 1; i <= result.meta.last; i++) {
                  var listPage = $('<li></li>');
                  if(result.meta.current == i) {
                    listPage.addClass('active');
                  }
                  var linkPage = $('<a></a>').attr('url', '#').attr('data-url', i).text(i).appendTo(listPage);
                  listPage.appendTo(paginationHolder);
                }
              }
              $('.pagination a').click(function(e) {
                e.preventDefault();
                var page = $(this).attr('data-url');
                var currentUrl = window.location.href;
               
               var newUrl = updateUrl(currentUrl,'page',page);
                if (window.history.pushState) {
                  window.history.pushState({path:newUrl}, '', newUrl);
                }
                var apiUrl = app.host + 'campaign/search' + window.location.search;
                apiUrl = updateUrl(apiUrl, 'page', page);
                // apiUrl = updateUrl(apiUrl, 'user_id', {{ session()->get('user.id') }});
                loadData(apiUrl);
              });

              
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
            var errorMsg = '';
            
            
            errorMsg += app.handleError(result.responseJSON.meta.message);  
            

            if(result.responseJSON.meta.errors){
              errorMsg += 'Your input does not valid :';
              errorMsg += app.handleError(result.responseJSON.meta.errors); 
            }
            
            $('.alert')
              .removeClass('alert-danger')
              .removeClass('alert-success')
              .addClass('alert-danger')
              .slideDown()
              .html(errorMsg);
              $('.overlay').hide();
          }
        });
      };
    });

  </script>
  @stop