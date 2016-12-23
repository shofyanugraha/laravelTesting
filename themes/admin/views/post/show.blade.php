@extends('admin::layout.main')
@section('css')
  <link href='{{asset("/assets/summernote/dist/summernote.css") }}' rel='stylesheet' type='text/css'>
  <link href='{{asset("/assets/jquery-colorbox/example2/colorbox.css") }}' rel='stylesheet' type='text/css'>
@stop
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ $campaign->data->title }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="ion-ios-home-outline"></i> Home</a></li>
        <li><a href="{{ url('/campaign') }}">Kampanye</a></li>
        <li class="active">Kampanye Detail</li>
      </ol>
    </section>
    <section class="content">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon">Rp.</span>

            <div class="info-box-content">
              <span class="info-box-text">Profit</span>
              @if($campaign->data->profit_campaign !== null)
              <span class="info-box-number">{{ isset($campaign->data->profit_campaign) ? number_format($campaign->data->profit_campaign->profit, 0, '.',',') : 0 }}</span>
              @else 
              <span class="info-box-number">{{ isset($campaign->data->profit) ? number_format($campaign->data->profit->profit, 0, '.',',') : 0 }}</span>
              @endif
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon"><i class="ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Terjual</span>
              @if($campaign->data->profit_campaign !== null)
              <span class="info-box-number">{{ isset($campaign->data->profit_campaign)  ? $campaign->data->profit_campaign->quantity : 0 }}</span>
              @else
              <span class="info-box-number">{{ isset($campaign->data->profit)  ? $campaign->data->profit->quantity : 0 }}</span>
              @endif
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon"><i class="ion-ios-calendar-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Akhir Kampanye</span>
              <span class="info-box-number">{{ $campaign->data->end_date }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    </div>
    <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="{{ url('/campaign/'.$campaign->data->id) }}">Informasi Kampanye</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/affiliate') }}">Affiliate</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/assets') }}"  >Asset</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/customer') }}">Pelanggan</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/product') }}">Produk</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id) }}/production">production</a></li>
          </ul>
      <div class="campaign-detail">
        
          <div class="tab-content">
            <div class="tab-pane active" id="tabCampaign">
              <form class="form" id="updateCampaign">
                <div class="content">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="">Nama Kampanye</label>
                          <input type="text" class="form-control" id="campaignName" maxlength="40" value="{{ $campaign->data->title }}" {{ $end == true ? "disabled=disabled" : ""}}>

                          <p class="help-block">
                              Nama kampanye dalam 40 kata atau kurang
                          </p>
                      </div>
                      <div class="form-group">
                          <label class="">Deskripsi</label>
                          <div id="description">{!! html_entity_decode($campaign->data->desc) !!}</div>

                          <p class="help-block">
                              Jelaskan ke pelanggan tentang apa yang mereka beli.
                          </p>
                      </div>
                      <div class="form-group">
                          <label class="">URL</label>

                          <div>
                              <pre><a target="_blank" href="https://blazbluz.com/{{ $campaign->data->slug }}">https://blazbluz.com/{{ $campaign->data->slug }}</a></pre>
                          </div>
                      </div>         
                    </div>
                    <div class="col-md-6">
                      <div>
                        <label class="">Jangka Waktu</label>
                        
                            <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon">Tanggal Akhir
                                      /</span>
                                  <input type="text" class="form-control" id="endDate" data-date-format="DD-MM-YYYY" disabled="disabled" value="{{ $campaign->data->end_date }}">
                              </div>
                              <p class="help-block">
                                  Tanggal akhir dari kampanye.
                              </p>
                            </div>
                      </div>
                      <div class="form-group">
                          <label class="">Pixel ID</label>
                          <input type="text" class="form-control" id="facebookPixel" maxlength="40" placeholder="(Optional)" value="{{ $campaign->data->pixel }}" {{ $end == true ? "disabled=disabled" : ""}}>

                          <p class="help-block">Gunakan facebook <a href="https://developers.facebook.com/docs/marketing-api/audiences-api/pixel?locale=id_ID" target="_blank">pixel</a> untuk menjangkau konsumen lebih luas.
                          </p>
                      </div>
                      @if($end == true)
                        @if($campaign->data->relaunch == false)
                        <div class="canvas-tools" style="display:block; margin-bottom:1em;">
                          <h3 style="margin:0 ">Masa Kampanye telah berakhir</h3>
                        </div>
                        <p>
                        <a class="btn btn-primary" data-id="{{ $campaign->data->id }}" data-user-id="{{ session()->get('user.id') }}" id="relaunch">Luncurkan Kembali</a>
                        </p>
                        @else 
                          <div class="canvas-tools" style="display:block; margin-bottom:1em;">
                            <h3 style="margin:0 ">Kampanye sudah diluncurkan kembali</h3>
                          </div>
                          <p>
                          </p>
                        @endif
                      @else 
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      @if($end)
                        <a class="btn btn-warning" href="#" id="endNow">Akhiri Sekarang</a>
                      @endif
                    @endif
                    </div>
                  </div>       
                </div>    
              </form>
            </div>
          </div>
          <!-- /.tab-content -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  @stop
  @section('js')
  <script>
  $(document).ready(function() {
    $('#description').summernote({
        height:200,
        maxHeight: 350,
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['insert', ['picture', 'link']]
        ]
      });
    $('.viewImage').colorbox();
    @if($end)
    $('#description').summernote('disable');
    @endif
    $('#updateCampaign').validator().on('submit', function (e) {
      if (e.isDefaultPrevented()) {
        
      } else {
        e.preventDefault();
        $('.overlay').show();
        var fd = new FormData();

        fd.append('campaign_id', {{ $id }});
        fd.append('user_id', {{ session()->get('user.id') }});
        fd.append('title', $('#campaignName').val());
        fd.append('desc', $('#description').summernote('code').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;'));
        fd.append('pixel', $('#facebookPixel').val());

        $.ajax({
          url: app.host + 'campaign/update',
          type: "POST",
          processData: false,
          contentType: false,
          data: fd,
          success: function(result) {
            $('#create').hide();
            bootbox.alert('Kampanye berhasil diperbarui', function() {
              window.location.reload();
            });
            
          },
          error: function(result) {
            console.log(result);

            bootbox.alert('Kampanye gagal diperbarui, silahkan kontak admin');
            
          }
        });

      }

    });

    $('#endNow').click(function() {
      bootbox.confirm('Anda yakin untuk mengakhiri kampanye?', function(e) {
        if(e){
           $('.overlay').show();
        var fd = new FormData();

        fd.append('campaign_id', {{ $id }});
        fd.append('user_id', {{ session()->get('user.id') }});

        $.ajax({
          url: app.host + 'campaign/end',
          type: "POST",
          processData: false,
          contentType: false,
          data: fd,
          success: function(result) {
            $('#create').hide();
            bootbox.alert('Kampanye telah diakhiri');
            window.location.reload();
            $('.overlay').hide();
          },
          error: function(result) {
            bootbox.alert('Kampanye gagal diakhiri, silahkan kontak admin');
            
            $('.overlay').hide();
          }
        });
        }
      });
    });

    $('#relaunch').click(function() {
      bootbox.confirm('Anda yakin untuk meluncurkan kembali?', function(e) {
        if(e){
           $('.overlay').show();
        var fd = new FormData();

        fd.append('campaign_id', {{ $id }});
        fd.append('user_id', {{ session()->get('user.id') }});

        $.ajax({
          url: app.host + 'campaign/relaunch',
          type: "POST",
          processData: false,
          contentType: false,
          data: fd,
          success: function(result) {
            $('#create').hide();
            if(result.meta.status == true) {
              bootbox.alert('Kampanye telah diluncurkan kembali', function() {
                window.location.replace('/campaign/'+ result.data.id);
              });
              $('.overlay').hide();  
            } else {
              bootbox.alert(result.meta.message);
              $('.overlay').hide();  
            }
            
          },
          error: function(result) {
            bootbox.alert('Kampanye gagal diluncurkan kembali, silahkan kontak admin');
            $('.overlay').hide();
          }
        });
        }
      });
    });

    $('.detault-image').click(function() {
      var that = $(this);
      bootbox.confirm('Anda yakin gambar ini diset default?', function(e) {
        if(e){
           $('.overlay').show();
        var fd = new FormData();

        fd.append('campaign_id', {{ $id }});
        fd.append('default_image_id', that.attr('data-id'));
        fd.append('default_side', that.attr('data-side'));

        $.ajax({
          url: app.host + 'campaign/default',
          type: "POST",
          processData: false,
          contentType: false,
          data: fd,
          success: function(result) {
            $('#create').hide();
            bootbox.alert('Kampanye telah diakhiri');
            window.location.reload();
            $('.overlay').hide();
          },
          error: function(result) {
            bootbox.alert('Kampanye gagal diakhiri, silahkan kontak admin');
            
            $('.overlay').hide();
          }
        });
        }
      });
    });
  });
  </script>
  @stop 