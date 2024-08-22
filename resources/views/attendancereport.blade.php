@extends('Layouts.app')
@section('content')
    
<div class="row ">
<form action="{{route('attendancereport1.show')}}" method="POST">
    @csrf
<div class="row">
    <div class="col-4 ">
        
            <select class="form-select select2  " aria-label="Default" name="memberid" >
                <option selected>Search Member</option>
                @foreach ($members as $member )
                <option value="{{$member->id}}" {{old('memberid')==$member->id?'selected':''}}>{{$member->name}}</option>
           
@endforeach 
              </select>  
              @error('memberid')
              <p style="color: red">{{ $message }}</p>
          @enderror
    </div>
    <div class="col-3">
       <div class="input-group mb-3 " >
        <span class="input-group-text" id="basic-addon1">Start Date</span>
        <input type="date" class="form-control" id="startdate" name="startdate" value="{{old('startdate')}}">
      </div>
      @error('startdate')
      <p style="color: red">{{ $message }}</p>
  @enderror
    </div>
    <div class="col-3">
      <div class="input-group mb-3 " >
       <span class="input-group-text" id="basic-addon1">Expire Date</span>
       <input type="date" class="form-control" id="enddate" name="enddate" value="{{old('enddate')}}">
      </div>
      @error('enddate')
      <p style="color: red">{{ $message }}</p>
  @enderror
  </div> 

  <div class="col-2">
    <button type="submit" class="btn btn-primary">Submit</button>
</div> 
  </div>

</form>
</div>
@if(count($userAttendance)>0)

<div class="row">


    <div class="table-responsive">
        <table class="table " id="myTable" >
            <thead class="table-secondary">
              <td>Member ID</td>
              <td>Member Name</td>
              <td>Month</td>
              <td>Attendance Date</td>
            </thead>
            <tbody>
        @foreach ($userAttendance as $att )

        @php
            $date = $att->attendancedate;
$dateTime = new DateTime($date);
$monthName = $dateTime->format('F'); // Full month name (e.g., August)
        @endphp
        
        <tr >
            <td>{{$att->member_id}}</td>
            <td> {{$att->name}}</td>
            <td>{{$monthName }}</td>
            <td>{{$att->attendancedate}}</td>

          </tr>
        
            
        @endforeach
        
        </tbody>
        </table>
        </div>

</div>

@else
<div class="row">

    <div class="alert alert-warning text-center" role="alert">
        Please Generate Attendance Report
      </div>

</div>
@endif












<script>

    var select_box_element = document.querySelector('#memberid');

    dselect(select_box_element, {
        search: true
    });

</script>
<script>
$('.select2').select2();
</script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable({

        "lengthMenu": [10, 100, 200],
        

    });
});
</script>


@endsection