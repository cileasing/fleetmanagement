@extends('layouts.layout')

@section('content')

 

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  {{ ucwords(str_replace('_', ' ', $url)) }}
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> SysManager</a></li>
        <li class="active">{{ ucwords(str_replace('_', ' ', $url)) }}</li>
      </ol>
    </section>
 

<!-- Main content -->
    <section class="content">
        
        <div class="btn-group">
            <!--<a href="{{ route('form.url', ['url' => $url]) }}"><button type="button" class="btn bg-maroon btn-flat margin">Add</button></a>
            <a href=""><button type="button" class="btn bg-purple btn-flat margin">Export</button></a>-->
        <!--     <button type="button" class="btn bg-navy btn-flat margin">.btn.bg-navy.btn-flat</button>
                <button type="button" class="btn bg-orange btn-flat margin">.btn.bg-orange.btn-flat</button>
                <button type="button" class="btn bg-olive btn-flat margin">.btn.bg-olive.btn-flat</button> -->
        </div>
      <!-- /.row -->
      
      
      
      
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Maintenance Request </h3>
              
                
               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                   
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-left">
                    <!--<strong>Advance Search</strong>-->
                  </p>
                  <div class="advance">
                      
                      <center><h2><b>LOOKUP VEHICLE IN GALOOLI</b></h2></center>
                  </div>
                </div>
              
              </div>
              <!-- /.row -->
            </div>
            
           
            <section class="content">
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
               <div class="box-body">
                   
                    <!-- <div class="form-group">
                        <div id="fromgalooli"></div>
                    </div>-->
              <div id="fromgalooli"></div>
                <label>Vehicle Name: </label> <small style="color:grey; margin-left:10px">(format : AKD 736 MU)</small>
                <form name="galoliform" id="galoliform" onSubmit="return false;">
                    <select class="form-control select2" style="width: 100%;" id="vehic_name" name="vehic_name">
                        <option>Select</option>
                    </select>

                    <center><br/><input type="hidden" name="dType" id="dType" value="fueling" />
                        <button hidden type="submit" onClick="process()" class="btn btn-primary btn-fill btn-xs">Process</button></center><br/>
                 </form>
                 
               </div>
              </div>
              <!-- /.row -->
            </div>
            
            </section>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
      
      
      
      
      
      
    </section>


<script src="{{ URL::asset('js/global.js') }}"></script>
<script src="{{ URL::asset('js/gal.js') }}"></script>

@endsection