<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        return view('manage-activities.activityList');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(activity $activity)
    {
    }

    public function edit(Activity $activity)
    {
    }

    public function update(Request $request, Activity $activity)
    {
    }

    public function destroy(Activity $activity)
    {
    }
}
