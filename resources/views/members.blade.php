@extends('Layouts.app')

@section('content')

@if(session('success'))
<p>{{ session('success') }}</p>
@endif

<div class="text-center pt-5">
    <h1>Members List</h1>
</div>

<table class="table table-dark">
    <thead>
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

<tr class="{{ $member->id % 2 === 0 ? '' : 'table-active' }}">
    <td>{{$member->id}}</td>
    <td>{{$member->name}}</td>
    <td>{{$member->dob}}</td>
    <td>{{$member->gender}}</td>
    <td>{{$member->mobile}}</td>
    <td>{{$member->weight}}</td>
    <td>{{$member->height}}</td>
    <td>{{$member->startDate}}</td>
    <td>{{$member->ExpireDate}}</td>
    <td>
      <a href="{{route('members.profile',$member->id)}}" class="btn btn-primary">Edit</button></a>

    </td>
    <td>
        <button type="submit" class="btn btn-danger">Delete</button>

    </td>


    
  </tr>

    
@endforeach
</tbody>
</table>
    
@endsection
