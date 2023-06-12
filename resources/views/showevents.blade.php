@extends('layouts.main')
@section('main-section')
@include('crud')
<?php
session_start();

//Start-> code to open Edit Event form model
if(isset($event1)) 
{
  
           
                echo'
               <script type="text/javascript">
                window.onload = function () {
                OpenBootstrapPopup();
                };
                function OpenBootstrapPopup() {
                $("#modal-2").modal("show");
                }
                </script>';
}
//End-> code to open Edit Event form model

//Start-> code to open Add Event form model
if(isset($_SESSION["id1"])) 
{
           
           
                echo'
                <script type="text/javascript">
                window.onload = function () {
                OpenBootstrapPopup();
                };
                function OpenBootstrapPopup() {
                $("#modal-1").modal("show");
                }
                </script>';

        session_destroy();

}  //End-> code to open Add Event form model

?>



<div class="container">
      <div class="row">
      <div class="col-lg-12">
       
      

        <button style="float:right" class="btn btn-outline-info border rounded-pill border-primary float-end  mb-5" type="button" data-bs-target="#modal-1" data-bs-toggle="modal" style="font-family: Play, sans-serif;margin-top: 2px;"><i class="far fa-plus-square" style="margin-right: 10px;"></i>Add Google Event</button>
       
			<table class="table table-hover" id="myTable">
			  <thead>
				<tr>
				  
				  <th scope="col">Event ID</th>
				  <th scope="col">Event Name</th>
                  <th scope="col">Event Description</th>
				  <th scope="col">Start Time</th>
				  <th scope="col">End Time</th>
				</tr>
			  </thead>
			  <tbody>
                 
                @if(isset($events))
              
                @foreach($events as $item)
				<tr id="1" >
				  <td class="index">{{$item->id}}</td>
				  <td class="indexInput">{{$item->name}}</td>
                  <td>{{$item->description}}</td>
				  <td>{{$item->startDateTime}}</td>
				  <td>{{$item->endDateTime}}</td>
				  <td> <a href="{{url('update_event/')}}/{{$item->id}}" type="button"  class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <a href="{{url('deleteevents/')}}/{{$item->id}}" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a></td>
				</tr>
               
                @endforeach
                @endif
				
			  </tbody>
			</table>
        </div>
      </div>
    </div>
    


@endsection