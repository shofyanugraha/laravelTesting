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
              <span class="info-box-number">{{ isset($campaign->data->profit) ? number_format($campaign->data->profit->profit, 0, '.',',') : 0 }}</span>
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
            <li><a href="{{ url('/campaign/'.$campaign->data->id) }}/production">Production</a></li>
          </ul>
      <div class="campaign-detail">
          <div class="tab-content">
              <ul class="nav nav-tabs">
            <li><a href="{{ url('/campaign/'.$campaign->data->id) }}/customer" id="tabCampaignButton" >Sudah Bayar</a></li>
            <li  class="active"><a href="{{ url('/campaign/'.$campaign->data->id) }}/unpaid" id="tabCampaignButton" >Belum Bayar</a></li>
            
            
          </ul>
               <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Invoice</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telpon</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($customer)) 
                        @foreach($customer as $cust)
                          <tr>
                            <td>{{ $cust->code }}</td>
                            <td>{{ $cust->full_name }}</td>
                            <td>{{ $cust->email }}</td>
                            <td>{{ $cust->handphone }}</td>
                          </tr>
                        @endforeach
                      @else 
                        <tr>
                          <td colspan="5" class="text-center">Belum ada pelanggan</td>
                        </tr>
                      @endif
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