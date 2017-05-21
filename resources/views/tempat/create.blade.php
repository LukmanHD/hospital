@extends('layouts.main')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@section('tempat', 'class="active"')

@section('css')
<style type="text/css">
#map-canvas {
   width: 100%;
   height:300px;
 }
 .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    height: 200px;
}
</style>
@stop

@section('tagscript')

  <script>
    function initialize() {
      
      // inisiasi default value coordinate
      document.getElementById("latitude").value = -6.883529;
      document.getElementById("longitude").value = 107.539919;

      var latlng = new google.maps.LatLng(-6.883529, 107.539919);
      
      var map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: latlng,
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var marker = new google.maps.Marker({
          position: latlng,
          map: map,
          title: 'Set lat/lon values for this property',
          draggable: true
      });

      google.maps.event.addListener(marker, 'dragend', function (event) {          
          var lat = (this.getPosition().lat()).toString();
          var lng = (this.getPosition().lng()).toString();

          document.getElementById("latitude").value = lat;
          document.getElementById("longitude").value = lng;
      });
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDAV-eqLoFkPGyHzVQRBWZQkPrPvOXiHQ&callback=initialize" type="text/javascript"></script>

  <script type="text/javascript">
    $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
      
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });   
  });
</script>
@stop

@section('content')
<div class="right_col" role="main">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Tempat</h2> 
          <div class="clearfix"></div>
        </div>

        <div class="x_content">

          <!-- start form for validation -->
          <form id="demo-form" enctype="multipart/form-data" action="{{url('/tempat/store')}}" method="POST" data-parsley-validate>
            {!! csrf_field() !!}
            <br/><label for="tempat">Nama Tempat * :</label>
            <input type="text" id="fullname" class="form-control" name="tempat" placehoder="nama tempat"  required />

            <br/><label for="heard">Kategori:</label>
            <select id="heard" class="form-control" name="kategori" required>
              <option disabled>Pilih..</option>
              @foreach($kategori as $kategor)
                	<option value="{{$kategor->id}}">{{ $kategor -> nama_kategori }}</option>
              @endforeach
            </select>

            <br/><label for="alamat">alamat * :</label>
            <input type="text" id="fullname" class="form-control" name="alamat" placehoder="alamat" required />

            <br/><label for="message">Keterangan :</label>
            <textarea id="message" required="required" class="form-control" name="keterangan" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 10 caracters long comment.."
              data-parsley-validation-threshold="10"></textarea>  

            <!-- image -->
            <br/><label for="message">Upload Gambar :</label>
            <div class="input-group">
              <span class="input-group-btn">
                  <span class="btn btn-default btn-file">
                      Browse… <input type="file" id="imgInp" name="image_file">
                  </span>
              </span>
              <input type="text" class="form-control" readonly>
            </div>
            <img id='img-upload'/>
            
            <!-- maps -->
            <input type=hidden id="latitude" name="latitude"></input>
            <input type=hidden id="longitude" name="longitude"></input>
            <br/><br/><label for="message">Pilih Lokasi :</label>
            <div id="map-canvas"></div>

            <br/>
            <br/>
            <div class="text-right">
              <button type="cancel" class="btn btn-primary" onclick="history.go(-1)">Cancel</button>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>

            <br/>
            <br/>

          </form>
          <!-- end form for validations -->
        </div>
      </div>
    </div>
  </div>
</div>
@stop