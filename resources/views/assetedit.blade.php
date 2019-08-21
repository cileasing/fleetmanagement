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
                    <h3 class="box-title"><center> EDIT {{ strtoupper($myassets->vessel_Name) }} </center></h3>
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

                
                        </div>
                    </div>



                    <form role="form" action="" method="post" id="mainForm" onsubmit="return false;">
                        <div class="setup-content" id="step-1">
                            
                            <div class="form-group">
                                <label>Vessel Name</label>
                                <input type="text" value="{{ $myassets->vessel_Name}}" name="assetName" id="assetName" required="required"  class="form-control">
                            </div>
                            
                            
                            
                             <div class="form-group">
                                <label>IMO Number</label>
                                <input value="{{ $myassets->IMO_Number}}" type="text" name="imoNumber" id="imoNumber" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Owners</label>
                                <select class="form-control" name="owner" id="owner" required>
                                     <option value="{{ $myassets->Owner_vessel_manager }}">{{  App\Owner::find($myassets->Owner_vessel_manager)->name }}</option>
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
                                     <option value="{{ $myassets->Client }}">{{ App\Client::find($myassets->Client)->name }}</option>
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
                                <input type="text" value="{{ $myassets->Gross_Tonnage }}" name="grosstonnage" id="grosstonnage" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>TEU Capacity</label>
                                <input type="text" value="{{ $myassets->TEU_Capacity }}" name="TEUcapacity" id="TEUcapacity" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Dead Weight</label>
                                <input type="text" value="{{ $myassets->Deadweight }}"  name="deadweight" id="deadweight" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Length</label>
                                <input type="text" value="{{ $myassets->Length }}" name="length" id="length" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Beam</label>
                                <input type="text" value="{{ $myassets->Beam }}" name="beam" id="beam" class="form-control">
                            </div>
                            
                            <center><button class="btn btn-danger nextBtn btn-sm newbtncl" type="button" >Next</button></center>
                        </div>

                        
                        
                        
                        <div class="setup-content" id="step-3">
                            
                            <div class="form-group">
                                <label>Which Contract</label>
                                <select name="whichContract" id="whichContract" class="form-control">
                                   <option value="{{ $myassets->contract_type }}">{{ App\Contractype::find($myassets->contract_type)->name }}</option>
                                    @if($cntype)
                                    @foreach($cntype as $gcln)
                                   <option value="{{$gcln->id}}">{{ $gcln->name }}</option>
                                     @endforeach
                                 @endif
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Age of Vessel</label>
                                <input type="text" value="{{ $myassets->Age_of_vessel }}" name="ageofvessel" id="ageofvessel" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Engine Power</label>
                                <input type="text" value="{{ $myassets->Engine_power }}" name="enginepower" id="enginepower" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Built</label>
                                <input type="text" value="{{ $myassets->Built }}" name="built" id="built" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Size</label>
                                <input type="text"  value="{{ $myassets->Size }}" name="size" id="size" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Draught</label>
                                <input type="text" value="{{ $myassets->Draught }}" name="draught" id="draught" class="form-control">
                            </div>
                            
                            
                            <div class="form-group">
                                <label>Builder</label>
                                <input type="text" value="{{ $myassets->Builder }}" name="builder" id="builder" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Place of Build</label>
                                <input type="text" value="{{ $myassets->Place_of_build }}" name="placeOfBuild" id="placeOfBuild" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Net Tonnage</label>
                                <input type="text" value="{{ $myassets->Net_Tonnage }}" name="netTonnage" id="netTonnage" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Crude</label>
                                <input type="text" value="{{ $myassets->Crude }}" name="crude" id="crude" class="form-control">
                            </div>
                            
                            <input type="hidden" value="{{ $myassets->id }}" name="assetID" id="assetID">
                             <input type="hidden" value="{{ $myassets->vessel_Ex_Name }}" name="slug" id="slug">
                           <center><button class="btn btn-success btn-sm newbtncl" id="pushvesselpostEdit" type="submit">Update</button></center>
                        </div>


                    </form>


                    <!--/////////////////////////////////////// we go here /////////////////////////////////////////// -->           



                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->





        </div>







    </div><!-- End of Row -->

</section>

<script src="{{ URL::asset('js/global.js') }}"></script>

<script src="{{ URL::asset('js/formstep.js') }}"></script>
<script src="{{ URL::asset('js/formpostedit.js') }}"></script>

@endsection