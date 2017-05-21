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
    border-width: 1px;
}
</style>
@stop

@section('tagscript')
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
	        <a href="/tempat/create" class="btn btn-round btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
	        <div class="clearfix"></div>
	      </div>

	      <div class="x_content">

          <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr class="headings">
                  <th class="column-title" width="3%">No </th>
                  <th class="column-title" width="20%">Tempat </th>
                  <th class="column-title" width="20%">alamat </th>
                  <th class="column-title" width="37%">Keterangan </th>
                  <th class="column-title" width="10%">image </th>
                  <th class="column-title no-link last"><span class="nobr">Action</span>
                  </th>
                  <th class="bulk-actions" colspan="7" width="10%">
                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                  </th>
                </tr>
              </thead>

              <tbody>
              <?php $i = 0; ?>
              @foreach($datas as $data)
              	<?php $i++; ?>
                <tr class="even pointer">
                  <td>{{ $i }}</td>
                  <td>{{ $data -> nama_tempat }}</td>
                  <td>{{ $data -> alamat }}</td>
                  <td>{{ $data -> keterangan }}</td>
                  <td data-toggle="modal" data-target="#myModal{{$data->id}}">
                        <img src="/images/{{$data->image}}" height="50px">
                  </td>
                  <td>
                  	<a class="btn btn-round btn-primary" href="/tempat/edit/{{Crypt::encrypt($data->id)}}"><i class="fa fa-pencil"></i></a>                  
              		<a class="btn btn-round btn-primary" href="/tempat/delete/{{$data->id}}" onclick="return confirm('tempat {{$data->nama_tempat}} akan dihapus?')"><i class="fa fa-trash"></i></a> 
                  </td>
                </tr>

                <!-- Modal -->
                <div id="myModal{{$data->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- konten modal-->
                    <div class="modal-content">
                      <!-- body modal -->
                      <div class="modal-body"> 
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <img src="/images/{{$data->image}}" width="100%">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- endmodal -->
              @endforeach
                
              </tbody>
            </table>
          </div>
          {!! $datas -> render() !!}
				
        </div>

	    </div>
	  </div>
	</div>



  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Kategori</h2> 
          <a data-toggle="modal" data-target="#modal-kategori" class="btn btn-round btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
          <div class="clearfix"></div>
        </div>
        @foreach($kategori as $kategori)
          <button class="btn btn-round btn-info">
            <a href="/tempat/kategori/{{Crypt::encrypt($kategori->id)}}" style="color:white">
              {{$kategori->nama_kategori}} 
            </a>
            <a data-toggle="modal" data-target="#modal-kategori-edit-{{$kategori->id}}" style="color:white" >  <i class="fa fa-pencil"></i></a>
            <a href="/tempat/kategori/delete/{{$kategori->id}}" onclick="return confirm('Kategori {{$kategori->nama_kategori}} akan dihapus?')" style="color:white" ><i class="fa fa-close"></i></a>
          </button>

          <!-- Modal kategori-edit -->
          <div id="modal-kategori-edit-{{$kategori->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- konten modal-->
              <div class="modal-content">
                <!-- body modal -->
                <div class="modal-body"> 
                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                  <!-- start form for kategori -->
                  <form id="demo-form" enctype="multipart/form-data" action="/tempat/kategori/update/{{$kategori->id}}" method="POST" data-parsley-validate>
                    {!! csrf_field() !!}
                    <br/><label for="tempat">Kategori * :</label>
                    <input type="text" id="fullname" class="form-control" name="kategori" placehoder="kategori"  value="{{$kategori->nama_kategori}}" required />

                    <!-- image -->
                    <br/><label for="image">Upload Gambar :</label>
                    <div class="input-group">
                      <span class="input-group-btn">
                          <span class="btn btn-default btn-file">
                              Browse… <input type="file" id="imgInp" name="image_file" value="{{$kategori->image}}">
                          </span>
                      </span>
                      <input type="text" class="form-control" readonly>
                    </div>
                    <img id='img-upload' src="/images/{{$kategori->image}}" />

                    <br/>
                    <div class="text-right">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>

                  </form>
                  <!-- end form for validations -->
                </div>
              </div>
            </div>
          </div>
          <!-- endmodal -->
        @endforeach

        <div class="x_content">
        </div>
      </div>
    </div>
  </div>

  <!-- Modal kategori -->
  <div id="modal-kategori" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- body modal -->
        <div class="modal-body"> 
          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <!-- start form for kategori -->
          <form id="demo-form" enctype="multipart/form-data" action="{{url('/tempat/kategori/store')}}" method="POST" data-parsley-validate>
            {!! csrf_field() !!}
            <br/><label for="tempat">Kategori * :</label>
            <input type="text" id="fullname" class="form-control" name="kategori" placehoder="kategori"  required />

            <!-- image -->
            <br/><label for="image">Upload Gambar :</label>
            <div class="input-group">
              <span class="input-group-btn">
                  <span class="btn btn-default btn-file">
                      Browse… <input type="file" id="imgInp" name="image_file">
                  </span>
              </span>
              <input type="text" class="form-control" readonly>
            </div>
            <img id='img-upload'/>

            <br/>
            <div class="text-right">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>

          </form>
          <!-- end form for validations -->
        </div>
      </div>
    </div>
  </div>
  <!-- endmodal -->

  

</div>
