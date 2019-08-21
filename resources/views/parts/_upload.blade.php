<section class="content">
    <div class="row">
        
          @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
        @endif
        
        
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">File Upload</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('modules.multiuploads') }}" method="POST" role="form" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Upload File</label>
                  <input multiple type="file" name="filenames[]" class="myfrm form-control">
                </div>
               

              <div class="box-footer">
                  <?php
                  echo '<input type="hidden" required name= "'.$tab->tab_item_id.'" }} id="'.$tab->tab_item_id.'" placeholder="'.$tab->tab_item_id.'" value="'.$formdata->$mp.'" class="form-control exAmount" min="0"/>';
                    echo '<input type="hidden" required name="url" id="url"  value="'.$url.'" class="form-control url" />';
                  ?>
             
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->


        </div>

    </div>
</section>


<section class="content">
    <div class="row">
        <?php
           $matchThese = ['request_id' => $formdata->$mp];
           $fileExist = App\Files::where($matchThese)->get(); // 0
           $i=1;
           if(isset($fileExist) &&  $fileExist != ""){
               echo "<table class='table table-responsive table-hover table-striped table-bordered'><tr><th>S/N</th><th>Original Name</th><th>New Filename</th><th>Download</th></tr>";
               foreach($fileExist  as $get){
                   echo "<tr><td>".$i++."</td><td>$get->org_filenames</td><td>$get->filenames</td><td><a href='http://localhost:8000/public/storage/$get->filenames'>View</a></td></tr>";
               }
               echo "</table>";
           }
        ?>
    </div>

</section>