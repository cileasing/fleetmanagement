@extends('layouts.layout')

@section('content')


 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ASSET
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Asset</a></li>
        <li class="active">active</li>
      </ol>
    </section>
 

<!-- Main content -->
    <section class="content">
        
        <div class="btn-group">
            <a href="{{ route('asset.addnew') }}"><button type="button" class="btn bg-maroon btn-flat margin">Add</button></a>
            <a href=""><button type="button" class="btn bg-purple btn-flat margin">Export</button></a>
        <!--     <button type="button" class="btn bg-navy btn-flat margin">.btn.bg-navy.btn-flat</button>
                <button type="button" class="btn bg-orange btn-flat margin">.btn.bg-orange.btn-flat</button>
                <button type="button" class="btn bg-olive btn-flat margin">.btn.bg-olive.btn-flat</button> -->
        </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title">Active Vessels &nbsp; <span class="badge badge-red">5</span></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                   <thead>
                <tr>
                  <th>ID</th>
                  <th>Vessel Name</th>
                  <th>Type</th>
                  <th>IMO Number</th>
                  <th>Owner</th>
                  <th>Client</th>
                  <th>Days Worked<br><small>(This Month)</small></th>
                  <th>Total Worked<br/><small>(Within the Year)</small></th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
               
                 </thead>
                        
                        <tbody id="contract_list">
                  @if($assetContract)
                   
                            @foreach($assetContract as $con)
                <tr>
                 <td>{{ $con->id }}</td>
                 <td><a href="">{{ $con->vessel_Name }} </a></td>
                 <td>{{ $con->vessel_Type }}</td>
                 <td>{{ $con->IMO_Number }}</td>
                   <td>{{ $con->Owner_vessel_manager }}</td>
                    <td>{{ $con->client }}</td>
                   <td>11</td>
                   <td>11</td>
                  <td><span class="label label-danger">{{ $con->status }}</span></td>
                  <td><a href="{{ route('asset.edit', ['id' => $con->id, 'slug' => $con->vessel_Ex_Name ]) }}"><span style="cursor:pointer" class="fa fa-edit" title="Edit"></span> </a>&nbsp; 
                      <a href="{{ route('asset.show', ['id' => $con->id, 'slug' => $con->vessel_Ex_Name ]) }}"> <span style="cursor:pointer" title="View" class="fa fa-file-picture-o"></span></a></td>
                </tr>
                 @endforeach
                 @endif
              </tbody>
                
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>



@endsection