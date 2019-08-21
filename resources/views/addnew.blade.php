@extends('layouts.layout')

@section('content')

<style type="text/css">
    .stepwizard-step p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        ASSET 
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Add New</a></li>
        <li class="active">active</li>
    </ol>
</section>


<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-6">

            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Add New</h3>
                </div>
                <div class="box-body">



                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">

                            <div class="stepwizard-step">
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                <p>Basic Information</p>
                            </div>

                            <div class="stepwizard-step">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                <p>Specification</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                <p>Other Information</p>
                            </div>

                            <div class="stepwizard-step">
                                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                                <p>Summary</p>
                            </div>
                        </div>
                    </div>



                    <form role="form" action="" method="post" id="mainForm" onsubmit="return false;">
                        <div class="setup-content" id="step-1">

                            <div class="form-group">
                                <label>Vessel Name</label>
                                <input type="text" name="assetName" id="assetName" required="required"  class="form-control">
                            </div>
                            
                             <div class="form-group">
                                <label>Vessel Type</label>
                                <select class="form-control" name="vesseType" id="vesseType" required>
                                    <option value="">Select Type</option>
                                    <option value="troophy">Trophy</option>
                                    <option value="control">in Control</option>
                                </select>
                            </div>
                            
                            
                             <div class="form-group">
                                <label>IMO Number</label>
                                <input type="text" name="imoNumber" id="imoNumber" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Owners</label>
                                <select class="form-control" name="owner" id="owner" required>
                                    <option>Select Type</option>
                                    @if($own)
                                    @foreach($own as $getcl)
                                    <option value="{{$getcl->id}}">{{ $getcl->name }}</option>
                                     @endforeach
                                 @endif
                                </select>
                            </div>
                            
                             <div class="form-group">
                                <label>Charterer(Client)</label>
                                <select class="form-control" name="client" id="client" required>
                                    <option>Select Type</option>
                                    @if($client)
                                    @foreach($client as $gcl)
                                   <option value="{{$gcl->id}}">{{ $gcl->name }}</option>
                                     @endforeach
                                 @endif
                                </select>
                            </div>
                            
                            <center><button class="btn btn-danger nextBtn btn-sm newbtncl" type="button" >Next</button></center>
                        </div>
                        
                        
                        
                        
                        

                        <div class="setup-content" id="step-2">
                           
                            <div class="form-group">
                                <label>Gross Tonnage</label>
                                <input type="text" name="grosstonnage" id="grosstonnage" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>TEU Capacity</label>
                                <input type="text" name="TEUcapacity" id="TEUcapacity" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Dead Weight</label>
                                <input type="text" name="deadweight" id="deadweight" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Length</label>
                                <input type="text" name="length" id="length" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Beam</label>
                                <input type="text" name="beam" id="beam" class="form-control">
                            </div>
                            
                            <center><button class="btn btn-danger nextBtn btn-sm newbtncl" type="button" >Next</button></center>
                        </div>

                        
                        
                        
                        <div class="setup-content" id="step-3">
                            
                            <div class="form-group">
                                <label>Which Contract</label>
                                <select name="whichContract" id="whichContract" class="form-control">
                                    <option>Select Type</option>
                                    @if($cntype)
                                    @foreach($cntype as $gcln)
                                   <option value="{{$gcln->id}}">{{ $gcln->name }}</option>
                                     @endforeach
                                 @endif
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Age of Vessel</label>
                                <input type="text" name="ageofvessel" id="ageofvessel" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Engine Power</label>
                                <input type="text" name="enginepower" id="enginepower" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Built</label>
                                <input type="text" name="built" id="built" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Size</label>
                                <input type="text" name="size" id="size" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Draught</label>
                                <input type="text" name="draught" id="draught" class="form-control">
                            </div>
                            
                            
                            <div class="form-group">
                                <label>Builder</label>
                                <input type="text" name="builder" id="builder" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Place of Build</label>
                                <input type="text" name="placeOfBuild" id="placeOfBuild" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Net Tonnage</label>
                                <input type="text" name="netTonnage" id="netTonnage" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Crude</label>
                                <input type="text" name="crude" id="crude" class="form-control">
                            </div>
                            
                            <center><button class="btn btn-danger nextBtn btn-sm newbtncl" type="button" >Next</button></center>
                        </div>


                        <div class="setup-content" id="step-4">
                            <hr/><!--<center><h5 class="badge badge-danger">Basic Information</h5></center>-->
                            <table class="table table-bordered">
                                <tr class="bg-primary">
                                    <th>Asset Name</th>
                                    <th>Type</th>
                                    <th>IMO Number</th>
                                    <th>Owner</th>
                                    <th>Client</th>
                                </tr>
                                
                                <tr>
                                    <td> <div id="view"></div></td>
                                    <td><div id="view2"></div></td>
                                    <td><div id="imoNumberview"></div></td>
                                    <td><div id="ownerview"></div></td>
                                    <td><div id="clientview"></div></td>
                                </tr>
                            </table>
                            
                            
                            <div class="col-md-12">
                                <!-- Widget: user widget style 1 -->
                                <div class="box box-widget widget-user-2">
                                  <!-- Add the bg color to the header using any of the bg-* classes -->
                                  <div class="widget-user-header bg-primary">
                                    <div class="widget-user-image">
                                      Specification
                                    </div>
                                  </div>
                                  <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                      <li><a href="#">Gross Tonnage <span class="pull-right badge bg-blue" id="grosstonnageview"></span></a></li>
                                      <li><a href="#">TEU Capacity <span class="pull-right badge bg-aqua" id="TEUcapacityview"></span></a></li>
                                      <li><a href="#">Dead Weight <span class="pull-right badge bg-green" id="deadweightview"></span></a></li>
                                      <li><a href="#">Length <span class="pull-right badge bg-red" id="lengthview"></span></a></li>
                                      <li><a href="#">Beam <span class="pull-right badge bg-primary" id="beamview"></span></a></li>
                                    </ul>
                                  </div>
                                </div>
                                <!-- /.widget-user -->
                          </div>
                            
                            
                            
                            
                            <div class="col-md-12">
                                <!-- Widget: user widget style 1 -->
                                <div class="box box-widget widget-user-2">
                                  <!-- Add the bg color to the header using any of the bg-* classes -->
                                  <div class="widget-user-header bg-primary">
                                    <div class="widget-user-image">
                                      Other Information
                                    </div>
                                  </div>
                                  <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                      <li><a href="#">Age of Vessel <span class="pull-right badge bg-blue" id="ageofvesselview"></span></a></li>
                                      <li><a href="#">Engine Power <span class="pull-right badge bg-aqua" id="enginepowerview"></span></a></li>
                                      <li><a href="#">Built <span class="pull-right badge bg-green" id="builtview"></span></a></li>
                                      <li><a href="#">Size <span class="pull-right badge bg-red" id="sizeview"></span></a></li>
                                      <li><a href="#">Draught <span class="pull-right badge bg-primary" id="draughtview"></span></a></li>
                                      <li><a href="#">Builder <span class="pull-right badge bg-black" id="builderview"></span></a></li>
                                      <li><a href="#">Place of Build <span class="pull-right badge bg-yellow" id="placeOfBuildview"></span></a></li>
                                      <li><a href="#">Net Tonnage <span class="pull-right badge bg-blue" id="netTonnageview"></span></a></li>
                                      <li><a href="#">Crude <span class="pull-right badge bg-black" id="crudeview"></span></a></li>
                                    </ul>
                                  </div>
                                </div>
                                <!-- /.widget-user -->
                          </div>
                           
                            
                            <center><button class="btn btn-success btn-sm newbtncl" id="pushvesselpost" type="submit">Finish</button></center>
                        </div>
                    </form>


                    <!--/////////////////////////////////////// we go here /////////////////////////////////////////// -->           



                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->





        </div>




        <!-- /.col (left) -->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Newly Added Marine Vessels</h3>
                </div>
                <div class="box-body">
                   
                    <div classs="table-responsive">
                    <table class="table table-borderless table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Asset Name</th>
                            <th>IMO Number</th>
                            <th>Owner</th>
                            <th>Charterer</th>
                             <th>Action</th>
                        </tr>
                        </thead>
                        
                        <tbody id="contract_list">
                            @if($assetContract)
                   
                            @foreach($assetContract as $con)
                        <tr>
                            <td>{{ $con->id }}</td>
                            <td>{{ $con->vessel_Name }} </td>
                            <td>{{ $con->IMO_Number }}</td>
                            <td>{{ $con->Owner_vessel_manager }}</td>
                            <td>{{ $con->Client }}</td>
                            <td>
                                <a href="{{ route('asset.edit', ['id' => $con->id, 'slug' => $con->vessel_Ex_Name ]) }}"><span style="cursor:pointer" class="fa fa-edit" title="Edit"></span></a> &nbsp; 
                                <a href="{{ route('asset.show', ['id' => $con->id, 'slug' => $con->vessel_Ex_Name ]) }}"><span style="cursor:pointer" title="View" class="fa fa-file-picture-o"></span></a>
                            </td>
                        </tr>
                        
                         @endforeach
                 @endif
                        </tbody>
                    </table>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->




        </div>



    </div><!-- End of Row -->

</section>

<script src="{{ URL::asset('js/global.js') }}"></script>
<script src="{{ URL::asset('js/formstep.js') }}"></script>
<script src="{{ URL::asset('js/twowaybinding.js') }}"></script>
<script src="{{ URL::asset('js/formpost.js') }}"></script>

@endsection