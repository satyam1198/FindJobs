<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::where('applied_by', Auth::user()->id)->with('jobPost')->latest()->get();

        return inertia('AppliedApplication', [
            'applications' => $applications
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);
    
        // Check if the user has already applied for this job
        $existingApplication = JobApplication::where('job_id', $request->job_id)
            ->where('applied_by', Auth::id())
            ->first();
    
        if ($existingApplication) {
            session()->flash('error', 'You have already applied for this job.');
            return redirect()->route('dashboard');
            // return back()->withErrors(['error' => 'You have already applied for this job.']);
        }

        

        $resumePath = $request->file('resume')->move(public_path('resumes'), time().'_'.$request->file('resume')->getClientOriginalName());
      
        JobApplication::create([
            'resume' => 'resumes/' . basename($resumePath),
            'cover_letter' => $request->cover_letter,
            'job_id' => $request->job_id,
            'applied_by' => Auth::id(),
            'status' => 'pending', // Default status
        ]);

        return redirect()->back()->with('success', 'Your application has been submitted successfully!');
    }
}
