@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2><b>View Activity</b></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row m-3">
                    <label for="activityName" class="col-sm-4 col-form-label">Activity Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="activity_name" name="activityName"
                            value="{{ $activity['activityName'] }}" readonly>
                    </div>
                </div>
                <div class="form-group row m-3">
                    <label for="activityDetails" class="col-sm-4 col-form-label">Activity Details</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="activity_details" name="activityDetails" rows="4" readonly
                            style="resize: none;">{{ $activity['activityDetails'] }}</textarea>
                    </div>
                </div>

                <div class="form-group row m-3">
                    <label for="location" class="col-sm-4 col-form-label">Location</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="location" name="location"
                            value="{{ $activity['location'] }}" readonly>
                    </div>
                </div>
                <div class="form-group row m-3">
                    <label for="activityDate" class="col-sm-4 col-form-label">Date</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="date" name="activityDate"
                            value="{{ $activity['activityDate'] }}" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row m-3">
                    <label for="startTime" class="col-sm-5 col-form-label">Start Time</label>
                    <div class="col-sm-7">
                        <input type="time" class="form-control" id="start_time" name="startTime"
                            value="{{ $activity['startTime'] }}" readonly>
                    </div>
                </div>
                <div class="form-group row m-3">
                    <label for="endTime" class="col-sm-5 col-form-label">End Time</label>
                    <div class="col-sm-7">
                        <input type="time" class="form-control" id="end_time" name="endTime"
                            value="{{ $activity['endTime'] }}" readonly>
                    </div>
                </div>
                <!--Only user/parents can participate -->
                @php
                    $today = \Carbon\Carbon::today();
                    $activityDate = \Carbon\Carbon::parse($activity['activityDate']);
                @endphp

                @if (auth()->user()->role == 'user')
                    <form id="participationForm"
                        action="{{ route('manageActivity.participate', ['activity' => $activity['id']]) }}" method="POST">
                        @csrf
                        <div class="form-group row m-3">
                            <label for="participate" class="col-sm-12 col-form-label"><b><u>Participation</u></b></label>
                            <select class="form-control" id="participate" name="student_id">
                                <option value="" selected disabled>Participate as</option>
                                @foreach ($students as $student)
                                    @if ($student->user_id == Auth::id())
                                        <option value="{{ $student->id }}">{{ $student->stdName }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-dark mr-2" onclick="window.history.back()">Back</button>
                @if ($activityDate->gt($today))
                    <button type="submit" class="btn"
                        style="background-color:#647687; color:white;">Participate</button>
                @else
                    <button type="button" class="btn" style="background-color:#647687; color:white;"
                        disabled>Participate</button>
                @endif
            </div>
        </div>
        </form>
        @endif

        <!--Teachers/Admin only sees BACK button -->
        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'teacher')
            <div class="row justify-content-end">
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-dark mr-2" onclick="window.history.back()">Back</button>
                </div>
            </div>
        @endif
    </div>

    <!--Teachers/Admin only access to participation list -->
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'teacher')
        <button type="button" class="btn" style="background-color:#647687; color:white;" id="participationListButton"
            data-bs-toggle="collapse" data-bs-target="#participatingStudents" aria-expanded="false"
            aria-controls="participatingStudents">
            <b>Participation List</b>
        </button>
        <!--Collapse/Expand contents-->
        <div class="row justify-content-center mt-3">
            <div class="col">
                <div class="collapse" id="participatingStudents">
                    <h4><b>Participating Students ({{ count($participatingStudents) }})</b></h4>
                    <ul class="list-group">
                        @foreach ($participatingStudents as $student)
                            <li class="list-group-item">{{ $student->stdName }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <script>
        $(document).ready(function() {
            $('#participationListButton').click(function() {
                $('#participatingStudents').toggleClass('show');

                if ($('#participatingStudents').hasClass('show')) {
                    $(this).html('Hide Participation List');
                } else {
                    $(this).html('Participation List');
                }
            });
        });
    </script>
@endsection
