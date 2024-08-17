<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Schedules;
use App\Models\Exercise_types;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MembersController extends Controller
{

  
  

    public function createMember(Request   $request ){

        $nextId = DB::select("SHOW TABLE STATUS LIKE 'members'")[0]->Auto_increment;
        
        $request->validate([
            'userName' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'dob' => 'required|date',
            'mobileNumber' => 'required|min:10|max:10',
            'membershiptype' =>'required|string|in:monthly,annual', 
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
            'membershiptype'=>$request->membershiptype,
            'height'=>  $request->height,
            'weight'=>  $request->weight,
            'startDate'=>$request->startdate,
            'ExpireDate'=>$request->enddate
        ]);

        Weight::create([
            'member_id'=>$nextId,
            'weight'=>  $request->weight,
        ]);

       

        return redirect()->route('members.data')->with('success', 'Data inserted successfully!');
        
    }



    public function ShowMembers(Request $request ){

       $members =  Members::all();

    

      

        return view('/members', compact('members'));

    }

    public function ShowMemberDetails(Request $request, $id ){

       
            $members=Members::all()->where('id',$id);
            $scheduleTypes = Exercise_types::all();
            $schedules = Schedules::join('members', 'schedules.member_id', '=', 'members.id')
            ->join('exercise_types', 'schedules.scheduleType_id', '=', 'exercise_types.id')
            ->select('schedules.*', 'exercise_types.name as exercise_name','schedules.noofsets','schedules.nooftime' )->where('schedules.member_id', $id)
            ->get();

            $memberWeights = Weight::all()->where($id);
           
           

            return view('memberprof', compact('members','scheduleTypes','schedules','memberWeights'));

    }

    public function EditMember(Request $request, $id ){

        $members=Members::all()->where('id',$id);
      

               

        return view('memberedit', compact('members'));

    }

    public function EditMemberDetails(Request $request, $id ){

        $member = Members::findOrFail($id);
        $memberweight = Weight::findOrFail($id);

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

        $member->name = $request->input('userName');
        $member->gender = $request->input('gender');
        $member->dob = $request->input('dob');
        $member->mobile = $request->input('mobileNumber');
        $member->height = $request->input('height');
        $member->weight = $request->input('weight');
        $member->startDate = $request->input('startdate');
        $member->ExpireDate = $request->input('enddate');

        Weight::create([
            'member_id'=>$id,
            'weight'=>  $request->weight,
        ]);

     
        $memberweight->save();
        $member->save();

        return redirect(route('members.data'))->with('success','User Update Success');
    }

    public function weightUpdate(Request $request, $id ){

        $member = Members::findOrFail($id);
        $memberweight = Weight::findOrFail($id);

          $request->validate([
            
            'weightUpdate' =>  'required|integer',

        ]);

     
        $member->weight = $request->input('weightUpdate');

        Weight::create([
            'member_id'=>$id,
            'weight'=>  $request->weightUpdate,
        ]);

     
        $memberweight->save();
        $member->save();

        return redirect()->route('members.profile', ['id' => $id])->with('success', 'User Weight Update Success');


    }

    public function memberscheduleEditpage(Request $request, $id,$sheduleid){

        $schedules = Schedules::join('members', 'schedules.member_id', '=', 'members.id')
        ->join('schedule_types', 'schedules.scheduleType_id', '=', 'schedule_types.id')
        ->select('schedules.*', 'schedules.id','schedules.member_id','schedule_types.name as exercise_name','schedules.noofsets','schedules.nooftime' )->where('schedules.id', $sheduleid)
        ->get();
       

        return view('memberscheduleedit',compact('schedules'));
    }

    
}
