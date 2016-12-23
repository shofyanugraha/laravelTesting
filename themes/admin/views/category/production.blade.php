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
        <li><a href="{{ url('/campaign') }}">Campaign</a></li>
        <li class="active">Campaign Detail</li>
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
      <div class="campaign-detail">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li><a href="{{ url('/campaign/'.$campaign->data->id) }}">Informasi Kampanye</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/affiliate') }}">Affiliate</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/assets') }}"  >Asset</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/customer') }}">Pelanggan</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/product') }}">Produk</a></li>
            <li class="active"><a href="{{ url('/campaign/'.$campaign->data->id) }}/production">production</a></li>
          </ul>
          <div class="tab-content">
                <div class="row">
                  <div class="col-md-2">
                    <label>Front Image</label>
                    <img src="{{ $campaign->data->front_raw_image }}" class="img-responsive">
                  </div>
                  <div class="col-md-2">
                    <label>Back Image</label>
                    <img src="{{ $campaign->data->back_raw_image }}" class="img-responsive">
                  </div>
                  
                  <div class="col-md-3">
                    
                  </div>
                  
                </div>
               <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Jenis Baju</th>
                        <th>Warna</th>
                        <th>S</th>
                        <th>M</th>
                        <th>L</th>
                        <th>XL</th>
                        <th>XXL</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($production as $prod)
                        <tr>
                          <td>{{ $prod->design }}</td>
                          <td>{{ $prod->color }}</td>
                          <td>{{ isset($prod->size->s) ? $prod->size->s : 0  }}</td>
                          <td>{{ isset($prod->size->m) ? $prod->size->m : 0  }}</td>
                          <td>{{ isset($prod->size->l) ? $prod->size->l : 0  }}</td>
                          <td>{{ isset($prod->size->xl) ? $prod->size->xl : 0  }}</td>
                          <td>{{ isset($prod->size->xxl) ? $prod->size->xxl : 0  }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
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
    $(document).ready(function() {
      $('#productionProceed').click(function() {
        $('.overlay').fadeIn();
        var fd = new FormData();
        
        fd.append('campaign_id', {{$campaign->data->id}});
        fd.append('admin_id', {{ \Sentinel::getUser()->id }});
        
          $.ajax({
            url: app.host + 'production/process',
            type: "POST",
            processData: false,
            contentType: false,
            data: fd,
            success: function(result) {
              $('.overlay').fadeOut();
              if (result.meta.code === 200) {
                bootbox.alert('Proses Produksi Dimulai', function() {
                  window.location.reload();
                });
              } else {
                bootbox.alert('Proses Produksi Gagal');
              }
            },
            error: function(result) {
              $('.overlay').fadeOut();
              bootbox.alert('Proses Produksi Gagal');
            }
          });
      
      });
    });
    
  });
  </script>
  @stop