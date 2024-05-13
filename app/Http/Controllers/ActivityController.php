<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Student;
use App\Models\Participation;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $datas = Activity::where('activityDate', '>=', $today) //Only retrieve data for date later than today
            ->orderBy('activityDate', 'asc') //Sort by date in ascending order
            ->paginate(8);

        return view('manageActivity.activityList', compact('datas'));
    }


    public function create()
    {
        return view('manageActivity.addActivity');
    }

    public function store(Request $request)
    {
        Activity::create($request->all());

        return redirect()->route('manageActivity.index')
            ->with('success', 'New activity successfully created!');
    }

    public function edit($id)
    {
        $activity = Activity::find($id)->toArray();
        return view('manageActivity.editActivity', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::find($id);
        $updated = $activity->update($request->all());

        if ($updated) {
            return redirect()->route('manageActivity.index')
                ->with('success', "Successfully edited activity.");
        } else {
        }
    }
    public function destroy(Activity $manageActivity)
    {
        $manageActivity->delete();
        return redirect()->route('manageActivity.index')->with('success', 'Activity successfully deleted!');
    }

    public function show($id)
    {
        $activity = Activity::findOrFail($id); //Find activity ID
        $students = Student::where('user_id', auth()->user()->id)->get(); //Get user's student objects

        $participations = Participation::where('activity_id', $activity->id) //Get participations associated with activity ID
            ->with('student')
            ->get();

        $participatingStudentIds = $participations->pluck('student_id'); //Get  participating student ID
        $participatingStudents = Student::whereIn('id', $participatingStudentIds)
            ->get(['id', 'stdName']);

        return view('manageActivity.showActivity', compact('activity', 'students', 'participations', 'participatingStudents'));
    }
    public function participate(Request $request, Activity $activity)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|integer|exists:students,id',
        ]);

        $existingParticipation = Participation::where('activity_id', $activity->id)
            ->where('student_id', $validatedData['student_id'])
            ->exists();

        if ($existingParticipation) {
            return redirect()->route('manageActivity.index')->with('failure', 'Duplicate entry found.'); //Reject if duplicate entry
        }

        $participation = new Participation;
        $participation->student_id = $validatedData['student_id'];
        $participation->activity_id = $activity->id;
        $participation->save();

        return redirect()->route('manageActivity.index')->with('success', 'Participation added successfully.');
    }

    public function participationList(Activity $activity)
    {
    }
}
