@extends('layouts.layout')

@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mail Configuration
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> mail</a></li>
        <li class="active">settings</li>
      </ol>
    </section>
 
 
  <!-- Main content -->
    <section class="content">
        <div class="row">
            
            
            <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mail Configuration</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="contractSetup" name="contractSetup">
               <!-- {{ csrf_field() }} -->
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Mail Driver</label>
                  <input type="type" class="form-control" id="ownerName" name="ownerName" placeholder="Enter Name">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Mail Host</label>
                  <input type="type" class="form-control" id="ownerName" name="ownerName" placeholder="Enter Name">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Port Number</label>
                  <input type="type" class="form-control" id="ownerName" name="ownerName" placeholder="Enter Name">
                </div>
                  
                 <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="type" class="form-control" id="ownerName" name="ownerName" placeholder="Enter Name">
                </div>
                  
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="type" class="form-control" id="ownerName" name="ownerName" placeholder="Enter Name">
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <button id="setupOwner" class="btn btn-primary">SAVE</button>
              </div>
            </form>
          </div>
          <!-- /.box -->



        </div>
            
            
            
            
            
         <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Email Configuration</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                  <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Owner</th>
                  <th>Progress</th>
                  <th style="width: 40px">Label</th>
                </tr>
                  </thead>
                <tbody id="contract_list">
                    
                
                  <tr>
                    <td>e</td>
                    <td>e</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                      </div>
                    </td>
                    <td>d</td>
                 </tr>
                 
               
                
                
                </tbody>
                
                
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
          
        </div>
        
        
        
        
            
        </div>
    </section>

<script src="{{ URL::asset('js/global.js') }}"></script>
<script src="{{ URL::asset('js/ownersetup.js') }}"></script>

@endsection