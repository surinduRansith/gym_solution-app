@extends('Layouts.app')

@section('content')

<a href="{{route('membersregistration.data')}}" class="btn"> User Registration</a>
<a href="{{route('members.data')}}" class="btn"> Member List</a>
    
@endsection
