<?php

namespace App\Http\Controllers;
use App\Models\Members;
use App\Models\ScheduleType;
use App\Models\Schedules;

use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    // public function storeSchedule(Request $request , $id){

    //     $members=Members::all()->where('id',$id);
      
    //     $this->validate($request,[
    //         'exerciselist'=> 'required',
    //         'numberofsets'=> 'required',
    //         'numberoftime'=> 'required'
    //     ]);

    //     $exersice= ScheduleType::all()->where('name',$request->exerciselist)->first();;
    //     Schedules::create([

    //         'member_id'=> $members->id,
    //         'sheduleType_id'=> $exersice->id,
    //         'noofsets'=>$request->numberofsets,
    //         'nooftime'=> $request->numberoftime,
    //     ]);

    //     return redirect()->route('membersprof')->with('success','done');

    // }

    public function storeSchedule(Request $request, $id)
    {
        $members=Members::all()->where('id',$id)->first();
        if (!$members) {
            return redirect()->back()->with('error', 'Member not found.');
        }
   
        $this->validate($request, [
            'exerciselist' => 'required',
            'numberofsets' => 'required',
            'numberoftime' => 'required'
        ]);

        $exercise = ScheduleType::all()->where('id', $request->exerciselist)->first();
        if (!$exercise) {
            return redirect()->back()->with('error', 'Exercise not found.');
        }

        Schedules::create([
            'member_id' => $members->id,
            'sheduleType_id' => $exercise->id,
            'noofsets' => $request->numberofsets,
            'nooftime' => $request->numberoftime,
        ]);

        return redirect()->route('members.profile', ['id' => $id])->with('success', 'Schedule created successfully.');
    }



}
