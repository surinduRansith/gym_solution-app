@extends('Layouts.app')

@section('content')

<div class="text-center pt-5">
    <h1>Members Registratoin</h1>
</div>

<form>
    <div class="mb-3">
      <label for="userName" class="form-label">User Name</label>
      <input type="text" class="form-control" id="userName" aria-describedby="emailHelp" name="userName">
      
    </div>
    <div class="mb-3">
      <label for="dob" class="form-label">Date of Birth</label>
      <input type="date" class="form-control" id="dob" name="dob">
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <div>
        <select class="form-select" aria-label="Default" name="gender">
            <option selected>Please select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
           
          </select>
    </div>
    <div>
        
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
    
@endsection