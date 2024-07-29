@extends('Layouts.app')

@section('content')

@if(session('success'))
<p>{{ session('success') }}</p>
@endif

 <!-- Breadcrumb -->
 <nav aria-label="breadcrumb" class="main-breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
 
  <li class="breadcrumb-item active" aria-current="page">Member List</li>
</ol>
</nav>
<!-- /Breadcrumb -->

<div class="text-start pt-5">
  <a href="{{route('membersregistration.data')}}" class="btn btn-primary">
    <i class="lni lni-user"></i>
    <span>Add Member </span>
</a>
</div>


<table class="table table-primary table-striped " id="myTable">
    <thead class="table-secondary">
      <td>Member ID</td>
      <td>Member Name</td>
      <td>Date of Birth</td>
      <td>Gender</td>
      <td>Mobile Number</td>
      <td>Weight</td>
      <td>Height</td>
      <td>Start Date</td>
      <td>Expire Date</td>
      <td></td>
      <td></td>
    </thead>
    <tbody>
@foreach ($members as $member )

<tr >
    <td>{{$member->id}}</td>
    <td><a href="{{route('members.profile',$member->id)}}"> {{$member->name}}</a></td>
    <td>{{$member->dob}}</td>
    <td>{{$member->gender}}</td>
    <td>{{$member->mobile}}</td>
    <td>{{$member->weight}}</td>
    <td>{{$member->height}}</td>
    <td>{{$member->startDate}}</td>
    <td>{{$member->ExpireDate}}</td>
    <td>
      <a href="{{route('members.edit',$member->id)}}" class="btn btn-primary">Edit</button></a>

    </td>
    <td>
        <button type="submit" class="btn btn-danger">Delete</button>

    </td>


    
  </tr>

    
@endforeach

</tbody>
</table>
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