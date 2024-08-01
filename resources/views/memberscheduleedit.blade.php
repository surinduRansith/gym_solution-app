@extends('Layouts.app')
@section('content')

@if (!empty($schedules))

<table class="table  table-primary table-striped">
  <thead>
    <th>Exersice Name</th>
    <th>No Of Sets</th>
    <th>No of Time</th>
    <th></th>
  </thead>
  <tbody>
      @foreach ($schedules as $schedule )
<form action="{{route('memberScheduleedit.update',['id' => $schedule->member_id, 'scheduleid' => $schedule->id])}}" method="POST">
    @csrf
    @method('PUT')
<tr>
  <td >{{$schedule->exercise_name}}</td>
  <td><input type="number" class="form-control" value="{{$schedule->noofsets}}" name="noofsets"> </td>
  <td><input type="number" class="form-control" value="{{$schedule->nooftime}}" name="nooftime"> </td>
  <form action="{{route('memberscheduleeditpagedelete.delete',['id' => $schedule->member_id, 'scheduleid' => $schedule->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <td> <button class="btn btn-sm btn-danger " type="submit"  ><i class="lni lni-eraser"></i></i></button> </td>
  </tr>
</form>
  
</tr>
@endforeach
<tr>
 <td colspan="4" class="align-middle"> <div class="text-center"><button class="btn btn-sm btn-primary " >update</button></div> </td>
</tr>
</tbody>
</table>

</form>
@endif
@endsection