<?php

namespace App\Http\Controllers;

use App\Models\ScheduleType;
use Illuminate\Http\Request;

class Schecule_typesController extends Controller
{
    public function index(){

        return view("scheduletype");
    }

    public function addtype(Request $request){

        $this->validate($request, [
            "schedulename"=> "required|max:255",
        ]);

        ScheduleType::create(
            [
                "name"=> $request->schedulename
            ]
        );

        return redirect()->route("scheduletype.insert")->with("success","Schedule Add Successfully");

    }

    public function getScheculeType(Request $request){ 

        $scheduleTypes = ScheduleType::all();

        return view("scheduletype", compact("scheduleTypes"));

    }
}
