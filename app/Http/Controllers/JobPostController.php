<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobPostController extends Controller
{
    public function index()
    {
        // Fetch jobs from database
        $jobs = JobPost::latest()->get();

        // Return jobs data to Vue
        return Inertia::render('Dashboard', [
            'jobs' => $jobs
        ]);
    }

    public function show($id)
    {
        // Fetch job post from database
        $job = JobPost::findOrFail($id);

        // Return job data to Vue
        return Inertia::render('JobPost', [
            'job' => $job
        ]);
    }

    public function store(Request $request)
    { 
        // Validate input fields
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:Full-time,Part-time,Contract,Remote,Internship',
            'salary_min' => 'nullable|integer|min:10000',
            'salary_max' => 'nullable|integer|gte:salary_min',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'requirements' => 'required|string',
            'perks' => 'nullable|string',
            'application_deadline' => 'required|date',
            'contact_email' => 'required|email',
            'website' => 'nullable|url',
        ]);

        // Store job post in database
        JobPost::create($request->all());

        // Redirect with success message
        return redirect()->route('dashboard')->with('success', 'Job post created successfully!');
    }   
}
