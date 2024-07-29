@extends('Layouts.app')

@section('content')

<div class="text-center pt-5">
    <h1>Members Registratoin</h1>
</div>
<br>

 <!-- Breadcrumb -->
 <nav aria-label="breadcrumb" class="main-breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{route('members.data')}}">Member List</a></li>
  <li class="breadcrumb-item active" aria-current="page">Member Edit</li>
</ol>
</nav>
<!-- /Breadcrumb -->

@foreach ($members as $member )


<form action="{{route('update.data',$member->id)}}" method="post">
  @csrf
  @method('PUT')
  <div class="container text-center">
    <div class="row">
      <div class="col-6">
      <div class="input-group mb-3 " >
        <span class="input-group-text" id="basic-addon1">User Name</span>
        <input type="text" class="form-control" id="userName" aria-describedby="emailHelp" name="userName" value="{{$member->name}}">
      </div>
      @error('userName')
      <p style="color: red">{{ $message }}</p>
  @enderror
      </div>
      <div class="col-6">
       <div class="input-group mb-3 " >
        <span class="input-group-text" id="basic-addon1">Date of Birth</span>
        <input type="date" class="form-control" id="dob" name="dob" value="{{$member->dob}}">
        
      </div>
      @error('dob')
      <p style="color: red">{{ $message }}</p>
  @enderror
      
      </div>
    </div>
    <div class="row">
    <div class="col-6">
        <div class="input-group mb-3 " >
          <span class="input-group-text" id="basic-addon1">Gender</span>
          <select class="form-select" aria-label="Default" name="gender" >
              <option selected>Please select Gender</option>
              <option value="male" {{$member->gender=='male'?'selected':''}}>Male</option>
              <option value="female" {{$member->gender=='female'?'selected':''}}>Female</option>
            </select>
      </div>
      @error('gender')
      <p style="color: red">{{ $message }}</p>
  @enderror
    </div>
    <div class="col-6">
     <div class="input-group mb-3 " >
      <span class="input-group-text" id="basic-addon1">Mobile Number</span>
      <input type="number" class="form-control" id="mobileNumber" name="mobileNumber" value="{{$member->mobile}}" >
      
    </div>
    @error('mobileNumber')
    <p style="color: red">{{ $message }}</p>
@enderror
    </div>

    </div>

    <div class="row">
      <div class="col-6">
     <div class="input-group mb-3 " >
      <span class="input-group-text" id="basic-addon1"> Height</span>
      <input type="number" class="form-control" id="height" name="height" value="{{$member->height}}">
    </div>
    @error('height')
    <p style="color: red">{{ $message }}</p>
@enderror
  </div>
  <div class="col-6">

    <div class="input-group mb-3 " >
      <span class="input-group-text" id="basic-addon1"> Weight</span>
      <input type="number" class="form-control" id="weight" name="weight" value="{{$member->weight}}">
    </div>
    @error('weight')
    <p style="color: red">{{ $message }}</p>
@enderror
  </div>
</div>

<div class="row">
  <div class="col-6">
     <div class="input-group mb-3 " >
      <span class="input-group-text" id="basic-addon1">Start Date</span>
      <input type="date" class="form-control" id="startdate" name="startdate" value="{{$member->startDate}}">
    </div>
    @error('startdate')
    <p style="color: red">{{ $message }}</p>
@enderror
  </div>
  <div class="col-6">
    <div class="input-group mb-3 " >
     <span class="input-group-text" id="basic-addon1">Expire Date</span>
     <input type="date" class="form-control" id="enddate" name="enddate" value="{{$member->ExpireDate}}">
    </div>
    @error('enddate')
    <p style="color: red">{{ $message }}</p>
@enderror
</div> 
</div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  </form>
  @endforeach
@endsection