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
            <li class="active"><a href="{{ url('/campaign/'.$campaign->data->id.'/affiliate') }}">Affiliate</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/assets') }}"  >Asset</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/customer') }}">Pelanggan</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id.'/product') }}">Produk</a></li>
            <li><a href="{{ url('/campaign/'.$campaign->data->id) }}/production">production</a></li>
          </ul>
      <div class="campaign-detail">
        
          <div class="tab-content">
              <div class="form-horizontal">
                <div class="form-group">
                  <div class="col-sm-4">Nama</div>
                  <div class="col-sm-8">
                    {{ $affiliate->data->full_name }}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-4">Email</div>
                  <div class="col-sm-8">
                    {{ $affiliate->data->email }}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-4">Phone</div>
                  <div class="col-sm-8">
                    {{ isset($affiliate->data->user_profile->phone) ? $affiliate->data->user_profile->phone : '-' }}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-4">Tshirt Size</div>
                  <div class="col-sm-8">
                    {{ isset($affiliate->data->user_profile->tshirt_size) ? $affiliate->data->user_profile->tshirt_size : '-' }}
                  </div>
                </div>

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