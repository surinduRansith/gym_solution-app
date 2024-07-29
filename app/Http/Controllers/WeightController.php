<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use Illuminate\Http\Request;
use App\Models\Members;

class WeightController extends Controller
{
  
    public function createWeight(Request   $request ){

       

        $request->validate([
            
            'weight' =>  'required|integer',
           

        ]);

        Weight::create([
           
           
            
            'weight'=>  $request->weight,
          
        ]);

        return redirect()->back()->with('success', 'Date inserted successfully!');


       

    }
}
