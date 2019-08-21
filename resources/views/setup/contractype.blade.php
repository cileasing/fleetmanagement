@extends('layouts.layout')

@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setup Contract
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">contract</li>
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
              <h3 class="box-title">Quick Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="contractSetup" name="contractSetup">
               <!-- {{ csrf_field() }} -->
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Contract Name</label>
                  <input type="text" class="form-control" id="contractName" name="contractName" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Status</label>
                  <select class="form-control" id="dStatus" name="dStatus">
                      <option value="">Select Option</option>
                        <option value="active">Active</option>
                         <option value="inactive">In-active</option>
                  </select>
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <button id="setupContract" class="btn btn-primary">SAVE</button>
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
              <h3 class="box-title">All Contracts</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                  <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Contract</th>
                  <th>Progress</th>
                  <th style="width: 40px">Label</th>
                </tr>
                  </thead>
                <tbody id="contract_list">
                    
                   @if($setupContract)
                   
                    @foreach($setupContract as $con)
                    
                  <tr>
                    <td>{{ $con->id }}</td>
                    <td>{{ $con->name }}</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                      </div>
                    </td>
                    <td>
                         @if($con->type == 'active')
                        <span class="badge bg-red">{{ $con->type }}</span>
                        
                        @else
                         <span class="badge bg-yellow">{{ $con->type }}</span>
                         @endif
                    </td>
                 </tr>
                 
                 @endforeach
                @endif
                
                
                
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
<script src="{{ URL::asset('js/contractsetup.js') }}"></script>

@endsection