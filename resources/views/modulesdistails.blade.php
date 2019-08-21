@extends('layouts.layout')

@section('content')

<!-- fullCalendar -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
 <!-- Content Header (Page header) -->
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  {{ ucwords(str_replace('_', ' ', $url)) }}
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Item Number</a></li>
        <li class="active">{{ $id }}</li>
      </ol>
    </section>
 

<!-- Main content -->
    <section class="content">
        
        <div class="btn-group">
            <!--<a href="{{ route('form.url', ['url' => $url]) }}"><button type="button" class="btn bg-maroon btn-flat margin">Add</button></a>
            <a href=""><button type="button" class="btn bg-purple btn-flat margin">Export</button></a>-->
      
        </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ ucwords(str_replace('_', ' ', $url)) }} &nbsp;</h3>

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
              
                   <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Basic Information</a></li>
               <?php 
               $num = 2;
              foreach($alltabs as $tab){
                  echo '<li><a href="#tab_'.$num.'" data-toggle="tab">'.$tab['tab_name'].'</a></li>';
                  $num++;
              }
              ?>
             <!--<li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Asset Utilization <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#tab_2" data-toggle="tab">Calender View</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Form View</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">List View</a></li>
                   <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Graph View</a></li>
                </ul>
              </li>-->
             
              <!--<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>-->
            </ul>
             
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <table class="table table-responsive">
                      
                       <?php
                          $fformdata = "";
                         $formID = isset($id) && $id != "" ? $id : '';
                          
			  foreach($formItems as $item){
				  $iitem = explode('-', trim($item));
                 $fformdata = isset($formdata[$iitem[1]]) && trim(isset($formdata[$iitem[1]])) != '' ? $formdata[$iitem[1]] : '';
                
                if(trim($iitem[1]) == 'cid' && $fformdata == '0'){
                    $itemvalue = 'All';
                } 
                elseif($iitem[0] == 'select' && is_numeric($fformdata)){
                    $itemmatch = ['modules_id' => $iitem[2]];
                    $modclass = 'App\Modules';
                    $iTable = $modclass::where($itemmatch)->value('module_table');
                    $iTablePk = $modclass::where($itemmatch)->value('module_primary_key');
                    $iTableunique = $modclass::where($itemmatch)->value('modules_unique_item');
                    $iclassName = 'App\\'.$iTable;
                    $itemmatchval = [$iTablePk => $fformdata];
                    $itemvalue = $fformdata != '0' ? $iclassName::where($itemmatchval)->value($iTableunique) : 'None';
                }
                elseif($iitem[0] == 'select_multiple'){
                    $itemmatch = ['modules_id' => $iitem[2]];
                    $modclass = 'App\Modules';
                    $iTable = $modclass::where($itemmatch)->value('module_table');
                    $iTablePk = $modclass::where($itemmatch)->value('module_primary_key');
                    $iTableunique = $modclass::where($itemmatch)->value('modules_unique_item');
                    $iclassName = 'App\\'.$iTable;
                    $smitemvalue = '';
                    foreach(explode(', ', $fformdata) as $itemss){
                        $itemmatchval = [$iTablePk => $itemss];
                        $smitemvalue .= $iclassName::where($itemmatchval)->value($iTableunique).', ';
                    }
                    $itemvalue = substr($smitemvalue, 0, -2);
                }
                elseif($iitem[1] == 'logged_by' || $iitem[1] == 'created_by'){
                    $itemmatchval = ['id' => $fformdata];
                    $itemvalue = User::where($itemmatchval)->value('name');
                }
                elseif($iitem[0] == 'password'){
                    $itemvalue = $fformdata;
                }
                elseif($iitem[0] == 'on_off'){
                    $itemvalue = ($fformdata == '1') ? 'Active' : 'Inactive';
                }
                elseif($fformdata == '0' && ($iitem[0] == 'text' || $iitem[0] == 'number' || $iitem[0] == 'textarea') ){
                    $itemvalue = 'Nil';
                }
                else  $itemvalue = $fformdata;
                $title = trim($iitem[1]) == 'cid' ? 'Company' : ucwords(str_replace('_', ' ', $iitem[1]));
				  echo '';
				 echo  '<tr>
                                        <th style="width:30%">'.$title.'</th>
                                        <td style="width:70%">'.$itemvalue.'</td>
                                    </tr>';
                      
				  echo '';
			  }
			
			  ?>               
                  </table>
              </div>
                
               
                
                @foreach($alltabs as $key => $tab )  
               
                    
                <div class="tab-pane" id="tab_{{ $key+2 }}">
                     @if($tab['tab_view']  == 'calendar') 
                    
                      <?php
                      
                      route('utilize', ['url' => $url, 'id' => $formdata->$mp, 'tabItem' =>$tab['tab_item'], 'tabItemID' =>$tab['tab_item_id']]); 
                        
                      ?>
                     
                        @include('parts/_calender')
                     @endif
                     
                     @if ($tab->tab_view === 'list')  
                         @include('parts/_list')
                        
                     @endif
                     
                     @if ($tab->tab_view === 'addform')  
                         @include('parts/_addform')
                        
                     @endif
                     
                     @if ($tab->tab_view === 'form')  
                         @include('parts/_forms')
                        
                     @endif
                     
                     @if ($tab->tab_view === 'graph')  
                         @include('parts/_graph')
                        
                     @endif
                     
                     @if ($tab->tab_view === 'invoice')  
                         @include('parts/_invoice')
                        
                     @endif
                     
                      @if ($tab->tab_view === 'multipleform')  
                         @include('parts/_multiforms')
                        
                     @endif
                     
                      
                     
                      @if ($tab->tab_view === 'fileUpload')  
                         @include('parts/_upload')
                        
                     @endif
                    
                   </div> 
                @endforeach 
                
              
              <?php 
             /* $count = 2;
              foreach($alltabs as $tab){
                echo '<div class="tab-pane" id="tab_'.$count.'">';
                if(strtolower(trim($tab['tab_view'])) == "calendar"){
                    echo "working";
                    @include('parts/_calender');
                }
                elseif ($tab['tab_view'] == 'form') {
                    @include('');
                }
                elseif ($tab['tab_view'] == 'invoice') {
                    @include('');
                }
                elseif ($tab['tab_view'] == 'graph') {
                    @include('');
                }
                else{
                   @include(''); 
                }
               
                  
              echo '</div>';
                  
                  $count++;
              }
              */
              ?> 
             
            </div>
            <!-- /.tab-content -->
          </div>
                   
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>


<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- fullCalendar -->
<script src="{{ URL::asset('bower_components/moment/moment.js') }}"></script>
<script src="{{ URL::asset('bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
        // defaultView: 'agendaWeek',
        defaultView: 'month',
        //defaultView: 'listWeek',
        //defaultView: 'basicWeek',
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay, prevYear'
      },
      buttonText: {
        today:    'today',
        month:    'month',
        week:     'week',
        day:      'day',
        list:     'list'
      },
      //Random default events
          
    /*  events    : [
        {
          title          : 'Worked',
          start          : new Date(y, m, 1),
          backgroundColor: '#00a65a', //red
          borderColor    : '#00a65a' //red
        },
        {
          title          : 'No Work',
          start          : new Date(y, m, d - 5),
          end            : new Date(y, m, d - 2),
          backgroundColor: '#f56954', //yellow
          borderColor    : '#f56954' //yellow
        },
        {
          title          : 'Worked',
          start          : new Date(y, m, d, 10, 30),
          allDay         : false,
          backgroundColor: '#00a65a', //Blue
          borderColor    : '#00a65a' //Blue
        },
        {
          title          : 'Worked',
          start          : new Date(y, m, d, 12, 0),
          end            : new Date(y, m, d, 14, 0),
          allDay         : false,
          backgroundColor: '#00a65a', //Info (aqua)
          borderColor    : '#00a65a' //Info (aqua)
        },
        {
          title          : 'No Work',
          start          : new Date(y, m, d + 1, 19, 0),
          end            : new Date(y, m, d + 1, 22, 30),
          allDay         : false,
          backgroundColor: '#f56954', //Success (green)
          borderColor    : '#f56954' //Success (green)
        },
        {
          title          : 'Under-Maintenance',
          start          : new Date(y, m, 28),
          end            : new Date(y, m, 29),
          url            : 'http://google.com/',
          backgroundColor: '#f39c12', //Primary (light-blue)
          borderColor    : '#f39c12' //Primary (light-blue)
        }
      ],
        */
     events    :  "https://sys.c-ileasing.com/utilize/<?php echo isset($url) && trim($url) != '' ? $url : ''; ?>/<?php echo isset($formdata->$mp) && trim($formdata->$mp) != '' ? $formdata->$mp : ''; ?>/<?php echo isset($tab['tab_item']) && trim($tab['tab_item']) != '' ? $tab['tab_item'] : ''; ?>/<?php echo isset($tab['tab_item_id']) && trim($tab['tab_item_id']) != '' ? $tab['tab_item_id'] : ''; ?>",
       
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

       
         const data = {
            title: originalEventObject.title,
            calenderDate : date.format(),
            
        
         }
          alert(originalEventObject.title);
        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      },
      
     dayClick: function(date, jsEvent, view, events) {

    //alert('Event: ' + events);
    //alert('Clicked on: ' + date.format());

    //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

   // alert('Current view: ' + view.name);

    // change the day's background color just for fun
    $(this).css('background-color', 'red');

  }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
@endsection