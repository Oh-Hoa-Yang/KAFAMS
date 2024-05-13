<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $datas = Activity::paginate(10);

        return view('manage-activities.activityList', compact('datas'));
    }

    public function create()
    {
        return view('manage-activities.addActivity');
    }

    public function store(Request $request)
    {
        Activity::create($request->all());

        return redirect()->route('manage-activities.index')
            ->with('Success', 'New activity successfully created!');
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
    public function show(activity $activity)
    {
    }
    public function participate(activity $activity)
    {
    }
    public function participationList(activity $activity)
    {
    }
}
