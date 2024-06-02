@extends('layouts.app')
@if (auth()->user()->role != 'admin' && auth()->user()->role != 'teacher')
    {{ abort(403, 'Unauthorized action.') }}
@endif
@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2><b>Edit Activity</b></h2>
            </div>
        </div>
        <form action="{{ route('manageActivity.update', ['manageActivity' => $activity['id']]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row m-3">
                        <label for="activityName" class="col-sm-4 col-form-label">Activity Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="activity_name" name="activityName"
                                value="{{ $activity['activityName'] }}">
                        </div>
                    </div>
                    <div class="form-group row m-3">
                        <label for="activityDetails" class="col-sm-4 col-form-label">Activity
                            Details</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="activity_details" name="activityDetails" rows="4">{{ $activity['activityDetails'] }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row m-3">
                        <label for="location" class="col-sm-4 col-form-label">Location</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ $activity['location'] }}">
                        </div>
                    </div>
                    <div class="form-group row m-3">
                        <label for="activityDate" class="col-sm-4 col-form-label">Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="date" name="activityDate"
                                value="{{ $activity['activityDate'] }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row m-3">
                        <label for="startTime" class="col-sm-5 col-form-label">Start Time</label>
                        <div class="col-sm-7">
                            <input type="time" class="form-control" id="start_time" name="startTime"
                                value="{{ $activity['startTime'] }}">
                        </div>
                    </div>
                    <div class="form-group row m-3">
                        <label for="endTime" class="col-sm-5 col-form-label">End Time</label>
                        <div class="col-sm-7">
                            <input type="time" class="form-control" id="end_time" name="endTime"
                                value="{{ $activity['endTime'] }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-2">
                    <div class="text-right">
                        <button type="button" class="btn btn-outline-dark mr-2"
                            onclick="window.history.back()">Cancel</button>
                        <!--Save into db/calls update() -->
                        <button type="submit" class="btn" style="background-color:#647687; color:white;">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
