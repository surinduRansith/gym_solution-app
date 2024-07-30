@extends('Layouts.app')

@section('content')

<div class="text-center pt-5">
    <h1>Schedule Type</h1>
</div>
<br>

 <!-- Breadcrumb -->
 <nav aria-label="breadcrumb" class="main-breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  {{-- <li class="breadcrumb-item"><a href="{{route('members.data')}}">Schedule Type</a></li> --}}
  <li class="breadcrumb-item active" aria-current="page">Schedule Type</li>
</ol>
</nav>
<!-- /Breadcrumb -->



<form action="{{route('scheduletype.add')}}" method="post">
  @csrf
  <div class="container text-center">
    <div class="row">
      <div class="col-6">
      <div class="input-group mb-3 " >
        <span class="input-group-text" id="basic-addon1">Add Schedule Type</span>
        <input type="text" class="form-control" id="schedulename" aria-describedby="emailHelp" name="schedulename" value="{{old('schedulename')}}">
      </div>
      @error('schedulename')
      <p style="color: red">{{ $message }}</p>
  @enderror
      </div>
      <div class="col-6">
        <div class="input-group mb-3 " >
            <button type="submit" class="btn btn-primary"><i class="lni lni-plus"></i>Add</button>
        </div>
    <br>
    
  </div>
  </form>


  @foreach ($scheduleTypes as $scheduleType )

  <p>{{$scheduleType->name}}</p>
      
  @endforeach
    
@endsection