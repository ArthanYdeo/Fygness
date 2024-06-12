<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gym; // Assuming Gym model is in the Models directory

class FindGymController extends Controller
{
    public function findgym(Request $request)
    {
        $query = $request->input('query');
        
        if ($query) {
            $gyms = Gym::where('name', 'like', '%' . $query . '%')->get();
        } else {
            $gyms = Gym::all();
        }
        
        return view('gymlist', compact('gyms', 'query'));
    }
}
