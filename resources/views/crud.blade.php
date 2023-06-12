
<!-- Start: Add Task Modal -->
<div class="modal fade" role="dialog" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #e0e5f5;">
                <h5 class="fs-6 fw-bold text-primary mb-0">Add New Event</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         
        <div class="modal-body" style="background: rgba(255,255,255,0);">
            <div class="card shadow" style="margin-right: auto;margin-left: auto;width: auto;">
                <div class="card-body">
                    <p class="card-text"></p>
                    <form id="form1" action="{{url('/')}}/addevents" method="post">
                        @csrf

                      
                        <label class="form-label" style="font-weight: bold;">Event Name</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input id="event1" class="border rounded border-secondary form-control form-control-sm" type="text" placeholder="Event Name" name="event" autocomplete="on"  >
                        <span class="text-danger ">
               @error('event')

               {{$message}}
               @enderror
                  </br>
             </span>





             <label class="form-label" style="font-weight: bold;">Event Description</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input id="dis1" class="border rounded border-secondary form-control form-control-sm" type="text" placeholder="Event Description" name="description" autocomplete="on"  >
                        <span class="text-danger ">
               @error('discription')

               {{$message}}
               @enderror
</br>
             </span>
            

             <label class="form-label" style="font-weight: bold;">Event Start Date and Time</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input  class="border rounded border-secondary form-control form-control-sm" type="date" placeholder="Event Start Date" name="start_date" autocomplete="on"  >
                        <span class="text-danger ">
               @error('start_date')

               {{$message}}
               @enderror
             </span>

             <input  class="border rounded border-secondary form-control form-control-sm" type="time" placeholder="Event Start Time" name="start_time" autocomplete="on"  >
                        <span class="text-danger ">
               @error('start_time')

               {{$message}}
               @enderror
</br>
             </span>


            

             <label class="form-label" style="font-weight: bold;">Event End Date and Time</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input  class="border rounded border-secondary form-control form-control-sm" type="date" placeholder="Event End Date" name="end_date" autocomplete="on"  >
                        <span class="text-danger ">
               @error('end_date')

               {{$message}}
               @enderror
             </span>

             <input  class="border rounded border-secondary form-control form-control-sm" type="time" placeholder="Event End Time" name="end_time" autocomplete="on"  >
                        <span class="text-danger ">
               @error('end_time')

               {{$message}}
               @enderror
             </span>
                        <button id="myaddcat" class="btn btn-outline-dark btn-sm text-center border rounded-pill border-secondary float-end" type="submit" style="margin-right: auto;margin-left: auto;margin-top: 20px;font-weight: bold;" name="myaddcat">Add Event</button></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- End: Add Task Modal -->



 <!-- Start: Edit Task Modal -->
 <div class="modal fade" role="dialog" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-2">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #e0e5f5;">
                <h5 class="fs-6 fw-bold text-primary mb-0">Edit Event</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         
        <div class="modal-body" style="background: rgba(255,255,255,0);">
            <div class="card shadow" style="margin-right: auto;margin-left: auto;width: auto;">
                <div class="card-body">
                    <p class="card-text"></p>
                    <form id="form1"  @if(isset($event1))
                  
                  action="{{url('/edit_event')}}/{{$event1->id}}"
                  
                  @endif >
                        @csrf

                      
                        <label class="form-label" style="font-weight: bold;">Event Name</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input id="event1" class="border rounded border-secondary form-control form-control-sm" type="text" placeholder="Event Name" name="event" autocomplete="on"  @if(isset($event1)) value="{{$event1->name}}" @endif >
                        <span class="text-danger ">
               @error('event')

               {{$message}}
               @enderror
                  </br>
             </span>





             <label class="form-label" style="font-weight: bold;">Event Description</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input id="dis1" class="border rounded border-secondary form-control form-control-sm" type="text" placeholder="Event Description" name="description" autocomplete="on" @if(isset($event1)) value="{{$event1->description}}" @endif>
                        <span class="text-danger ">
               @error('discription')

               {{$message}}
               @enderror
</br>
             </span>
            

             <label class="form-label" style="font-weight: bold;">Event Start Date and Time</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input  class="border rounded border-secondary form-control form-control-sm" type="date" placeholder="Event Start Date" name="start_date" autocomplete="on"  >
                        <span class="text-danger ">
               @error('start_date')

               {{$message}}
               @enderror
             </span>

             <input  class="border rounded border-secondary form-control form-control-sm" type="time" placeholder="Event Start Time" name="start_time" autocomplete="on"  >
                        <span class="text-danger ">
               @error('start_time')

               {{$message}}
               @enderror
</br>
             </span>


            

             <label class="form-label" style="font-weight: bold;">Event End Date and Time</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input  class="border rounded border-secondary form-control form-control-sm" type="date" placeholder="Event End Date" name="end_date" autocomplete="on"  >
                        <span class="text-danger ">
               @error('end_date')

               {{$message}}
               @enderror
             </span>

             <input  class="border rounded border-secondary form-control form-control-sm" type="time" placeholder="Event End Time" name="end_time" autocomplete="on"  >
                        <span class="text-danger ">
               @error('end_time')

               {{$message}}
               @enderror
             </span>
                        <button id="myaddcat" class="btn btn-outline-dark btn-sm text-center border rounded-pill border-secondary float-end" type="submit" style="margin-right: auto;margin-left: auto;margin-top: 20px;font-weight: bold;" name="myaddcat">Edit Event</button></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- End: Edit Task Modal -->
 
    