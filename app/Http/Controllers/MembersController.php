<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Weight;
use Illuminate\Http\Request;

class membersController extends Controller
{

  
    

    public function createMember(Request   $request ){

        $request->validate([
            'userName' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'dob' => 'required|date',
            'mobileNumber' => 'required|min:10|max:10',
            'height' =>  'required|integer',
            'weight' =>  'required|integer',
            'startdate' =>'required|date',
            'enddate' =>'required|date',

        ]);

       

        Members::create([
            'name' => $request->userName,
            'gender'=> $request->gender,
            'dob'=> $request->dob,
            'mobile'=> $request->mobileNumber,
            'height'=>  $request->height,
            'weight'=>  $request->weight,
            'startDate'=>$request->startdate,
            'ExpireDate'=>$request->enddate
        ]);

        return redirect(route('members.data'))->with('success', 'Date inserted successfully!');
    }

    public function ShowMembers(Request $request ){

       $members =  Members::all();

        return view('/members', compact('members'));

    }

    public function ShowMemberDetails(Request $request, $id ){

            $members=Members::all()->where('id',$id);

            return view('memberprof', compact('members'));

    }
}
