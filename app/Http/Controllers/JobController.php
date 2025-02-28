<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->paginate(3);

        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);

    }

    public function store()
    {
        //validation
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect('/jobs');
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        //authorize (On hold...)


        //validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        //update the job and persist

        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        //redirect

        return redirect('/jobs/'.$job->id);
    }

    public function destroy(Job $job)
    {
        //delete the job
        $job->delete();

        //redirect

        return redirect('/jobs');
    }
}
