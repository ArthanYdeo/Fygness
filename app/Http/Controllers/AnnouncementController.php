<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\ActivityLog; // Import the ActivityLog model
class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = "Admin Announcements"; 

        $announcements = Announcement::latest()->paginate(10);

        return view('Admin.adminannounce',$data, compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = "Staff Announcement";
        return view('Staff.staffannounce', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data['pendingTasks'] = Task::whereHas('user', function($query) {
            $query->where('user_type', 3);
        })->where('status', 'pending')->get();
        $data['completedTasks'] = Task::whereHas('user', function($query) {
            $query->where('user_type', 3);
        })->where('status', 'done')->get();

        $data['header_title'] = "Staff Announcement";
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Announcement::create($validatedData);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create announcement',
        ]);

        return view('Staff.staffdash',$data)->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);

        return view('announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);

        return view('announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($validatedData);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        
        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted successfully.');
    }
    
}
