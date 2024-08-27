

@extends('Layouts.app')
@section('content')
    


<div class="row ">
    <form action="{{route('userpaymentreport.show')}}" method="POST">
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
       
    <input name="testvalue" type="number" value="0" hidden>
      <div class="col-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div> 
      </div>
    
    </form>
    </div>
<br>



@if ($testvalue==0)
    

    @if(count($payments) >0)

    

    <div class="row">
        <div class="col-10">
            
        </div>
    <div class="col-2">
        
        @foreach ($payments as $payment )
        @endforeach
        
            <a href="{{route('userpaymentreportpdf.show',$payment->member_id)}}" class="btn btn-sm btn-danger"  title="Download PDF">
               <i class="fa-solid fa-file-pdf"></i>
            </a>
     

    </div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive">
            <table class="table " id="myTable" >
                <thead class="table-secondary">
                  <td>Member ID</td>
                  <td>Member Name</td>
                  <td>Membership Type</td>
                  @foreach ($payments as $payment )
                  @endforeach
                  @if ($payment->membership_type=='Monthly')
                  <td>Month</td>

                  @else
                  <td>Year</td>
                  @endif
                  
                  <td>Amount </td>
                </thead>
                <tbody>
            @foreach ($payments as $payment )
    
            @php
                $date = $payment->created_at;
    $dateTime = new DateTime($date);
    $YearName = $dateTime->format('Y'); // Full month name (e.g., August)
            @endphp
            
            <tr >
                <td>{{$payment->member_id}}</td>
                <td> {{$payment->name}}</td>
                <td>{{$payment->membership_type}}</td>
                @if ($payment->membership_type=='Monthly')
                <td>{{$payment->month}}</td>

                @else
                <td>{{$YearName}}</td>
                @endif
                <td>{{$payment->amount}}</td>
              </tr>
            
                
            @endforeach
            
            </tbody>
            </table>
            </div>
    
    </div>
    
    @else
    <div class="row">
    
        <div class="alert alert-danger text-center" role="alert">
            Data Not Available
          </div>
    
    </div>
    @endif

    @else
    <div class="row">
    
        <div class="alert alert-warning text-center" role="alert">
            Please Generate Payment Report
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