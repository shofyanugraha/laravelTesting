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
            <li><a href="{{ url('/campaign/'.$campaign->data->id) }}">Informasi Kampanye</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/affiliate') }}">Affiliate</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/assets') }}"  >Asset</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/customer') }}">Pelanggan</a></li>
            <li class="active"><a href="{{ url('/campaign/'.$campaign->data->id.'/product') }}">Produk</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id) }}/production">production</a></li>
          </ul>
      <div class="campaign-detail">
          <div class="tab-content">
    
              
               <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Produk</th>
                        <th>Harga Produksi</th>
                        <th>Harga Jual</th>
                        <th>Terjual</th>
                        <th>Profit</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($campaign->data->campaign_detail as $cmp) 
                        <tr>
                          <td><img src="{{ $cmp->thumb_front_image }}" class="" width="50"> <img src="{{ $cmp->thumb_back_image }}" width="50" class=""> {{ $cmp->design_detail->design->name }} - {{ $cmp->design_detail->color->name }}</td>

                          @if($campaign->data->profit_campaign->quantity < 10)
                          <td>{{ number_format($cmp->design_detail->design->base_price + $campaign->data->base_cost_dtg, 0, ',', '.') }}</td>
                          @else 
                          <td>{{ number_format($cmp->base_cost_cloth + $campaign->data->base_cost_canvas, 0, ',', '.') }}</td>
                          @endif
                          <td>{{ number_format($cmp->price, 0, ',', '.') }}</td>
                          <td>{{ $cmp->profit_detail->quantity or 0 }}</td>
                          <td>{{ isset($cmp->profit_detail->profit) ? number_format($cmp->profit_detail->profit, 0, ',', '.') : 0 }}</td>

                        </tr>
                      @empty 
                        <tr>
                          <td colspan="5" class="text-center">Belum ada pelanggan</td>
                        </tr>
                      @endforelse
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
    $('#selectCustomer').change(function() {
      var url = $(this).val();
      window.location = '{{ url("/campaign/". $campaign->data->id) }}/' + url;
    });
  });
  </script>
  @stop