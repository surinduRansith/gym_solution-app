@extends('Layouts.app')

@section('content')


   


<a href="{{route('membersregistration.data')}}" class="btn shadow p-3 mb-5 bg-body-tertiary rounded"> User Registration </a>
<a href="{{route('members.data')}}" class="btn shadow-sm p-3 mb-5 bg-body-tertiary rounded"> Member List</a>
    
@endsection
