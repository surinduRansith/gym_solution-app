<?php

namespace App\Http\Controllers;

use App\Models\exercise_types;
use App\Models\Members;
use App\Models\ScheduleType;
use App\Models\Schedules;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $exercise = exercise_types::all('name');
   
        $this->validate($request, [
            'exerciselist' => 'required',
            'numberofsets' => 'required',
            'numberoftime' => 'required'
        ]);

        $exercise = exercise_types::all()->where('id', $request->exerciselist)->first();
        if (!$exercise) {
            return redirect()->back()->with('error', 'Exercise not found.');
        }

        Schedules::create([
            'member_id' => $members->id,
            'scheduleType_id' => $exercise->id,
            'noofsets' => $request->numberofsets,
            'nooftime' => $request->numberoftime,
        ]);

        return redirect()->route('members.profile', ['id' => $id])->with('success', 'Schedule created successfully.');
    }

    public function memberscheduleUpdate(Request $request, $id,$scheduleid){



        $this->validate($request, [
            'noofsets' => 'required|integer',
            'nooftime' => 'required|integer'
        ]);
    
          DB::table('schedules')
        ->where('member_id', $id)
        ->where('id', $scheduleid)
        ->update([
            'noofsets' => $request->input('noofsets'),
            'nooftime' => $request->input('nooftime')
        ]);
    

       
        return redirect()->route('members.profile', ['id' => $id])->with('success', 'User Schedule Update Success');
    }

    public function memberscheduleDelete(Request $request, $id, $scheduleid){

 DB::table('schedules')
        ->where('member_id', $id)
        ->where('id', $scheduleid)
        ->delete();
    

    return redirect()->route('members.profile', ['id' => $id])->with('success', 'User Schedule Delete Success');
    }

    public function memberAllscheduleDelete(Request $request, $id){
        DB::table('schedules')
        ->where('member_id', $id)
        ->delete();
    

    return redirect()->route('members.profile', ['id' => $id])->with('success', 'User Schedule Delete Success');

    }
   

}
