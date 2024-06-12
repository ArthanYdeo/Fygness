<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;

class GymController extends Controller
{
    public function index()
    {
        $data['header_title'] = "Gyms";
        $gyms = Gym::all();
        return view('Admin.adminmanagegym', $data, compact('gyms'));
    }

    public function create()
    {
        $data['header_title'] = "Register a Gym";
        return view('gymcreate', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'inclusion' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[0-9]+$/|max:11', // Only accept numbers
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
        ]);

        $gym = new Gym();
        $gym->name = $request->name;
        $gym->email = $request->email;
        $gym->inclusion = $request->inclusion;
        $gym->owner = $request->owner;
        $gym->address = $request->address;
        $gym->phone_number = $request->phone_number;

        

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads'), $logoName);
            $gym->logo = $logoName;
        }

        $gym->save();

        return redirect()->route('gyms.index')->with('success', 'Gym created successfully.');
    }

    public function show($id)
    {
        $gym = Gym::findOrFail($id);
        return view('gyms.show', compact('gym'));
    }

    public function edit($id)
    {
        $gym = Gym::findOrFail($id);
        return view('gyms.edit', compact('gym'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'inclusion' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[0-9]+$/|max:11', // Only accept numbers
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
        ]);
    
        $gym = Gym::findOrFail($id);
        $gym->name = $request->name;
        $gym->email = $request->email;
        $gym->inclusion = $request->inclusion;
        $gym->owner = $request->owner;
        $gym->address = $request->address;
        $gym->phone_number = $request->phone_number;
    
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads'), $logoName);
            $gym->logo = $logoName;
        }
    
        $gym->save();
    
        return redirect()->route('gyms.index')->with('success', 'Gym updated successfully.');
    }
    

    public function destroy($id)
    {
        $gym = Gym::findOrFail($id);
        $gym->delete();

        return redirect()->route('gyms.index')->with('success', 'Gym deleted successfully.');
    }
}
