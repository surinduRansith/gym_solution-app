@extends('Layouts.app')
@section('content')

@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>

@endif

@foreach ($members as $member )

@php
        // Get the current date
        $now = new DateTime();

        // Retrieve the date of birth from the member object
        $dob = new DateTime($member->dob);

        // Calculate the difference in years (age)
        $age = $now->diff($dob)->y;
    @endphp

<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('members.data')}}">Member List</a></li>
              <li class="breadcrumb-item active" aria-current="page">Member Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                  <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{$member->gender == 'male'?'https://bootdey.com/img/Content/avatar/avatar7.png':'https://bootdey.com/img/Content/avatar/avatar3.png'}}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                        <h4> {{$member->name}}</h4>

                        
                       
                    </div>
                    <div class="mt-3">
                     
                      <div class="card">
                        <div class="card-body">
                          
                        </div>
                      </div>
                      
                     
                  </div>
                  </div>
                </div>
              </div>

              
             
    </div>
    
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->name}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date Of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->dob}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Age</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$age}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->gender}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->mobile}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Height(cm)</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->height}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Weight (kg)</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
<form action="{{route('weight.update',$member->id)}}" method="POST">
  @csrf
  @method('PUT')
                      <div class="input-group mb-3 " >
                        <input type="number" class="form-control" id="weightUpdate" name="weightUpdate" value="{{$member->weight}}">
                        <button class="btn  btn-primary " type="submit"  >Update</button>
                      </div>
                      
                    </form>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Start Date</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->startDate}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Expire Date</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->ExpireDate}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">BMI</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                
                       <?php
                       $heigtM = $member->height/100;


                    
                      ?>
                    
                        @if ($member->weight/($heigtM*$heigtM)<16)
                          {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color:#bc2020">Severe Thinness</p>
                        @elseif($member->weight/($heigtM*$heigtM)<17)
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #d38888">Moderate Thinness</p>
                        @elseif($member->weight/($heigtM*$heigtM)<17)
                        @elseif($member->weight/($heigtM*$heigtM)<18.5)
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #ffe400">Mild  Thinness</p>
                        @elseif($member->weight/($heigtM*$heigtM)<25)
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #008137">Normal</p>
                        @elseif($member->weight/($heigtM*$heigtM)<30)
                        {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #ffe400" >Overweight</p>
                        @elseif($member->weight/($heigtM*$heigtM)<35)
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #d38888">Obese Class I</p>
                        @elseif($member->weight/($heigtM*$heigtM)<40)
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #bc2020"> Obese Class II</p>
                        @else
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #8a0101">Obese Class III</p>
                          
                        @endif

                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <form action="{{route('updateshedule.insert',$member->id)}}" method="post">
                        @csrf
                      <h6 class="mb-0">Shedule</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                        <select class="form-select" aria-label="Default" name="exerciselist" >
                            <option selected>Select Exercise</option>
                            @foreach ($scheduleTypes as $exercise )
                            <option value="{{$exercise->id}}" >{{$exercise->name}}</option>
                            @endforeach
                          </select>
                    
                    </div>
                    <div class="col-sm-2 text-secondary">
                      <input type="number" class="form-control" id="numberofsets"  name="numberofsets">
                  </div>
                  <div class="col-sm-2 text-secondary">
                    <input type="number" class="form-control" id="numberoftime"  name="numberoftime" value="3">
                </div>
                <div class="col-sm-1 text-secondary">
                  <button type="submit" class="btn btn-warm">add</button>
              </div>
                  </div>
                  <hr>
                </form>
                  @endforeach
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="{{route('members.edit',$member->id)}}">Edit</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"></i>Weight Status</h6>
                      <small>Weight Control</small>
                      <div class="progress mb-3" style="height: 5px">
@extends('Charts.linechart')
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      
                      {{-- <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div> --}}
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                      <small>Web Design</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



            </div>
          </div>

        </div>
    </div>


    

    
@endsection