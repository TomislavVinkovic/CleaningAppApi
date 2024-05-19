<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Resources\Job\ListResource;
use App\Http\Resources\Job\ShowResource;

class JobController extends Controller
{
    public function list(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $listings = Job::where('user_id', auth()->id())
            ->with(['listing'])
            ->paginate($perPage);

        return ListResource::collection($listings);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $job->load(['listing']);
        return new ShowResource($job);
    }

    public function markAsComplete(Job $job) {
        $job->is_completed = true;
        $job->save();

        return [
            'data' => [
                'message' => 'Posao uspješno obavljen'
            ]
        ];
    }
}
