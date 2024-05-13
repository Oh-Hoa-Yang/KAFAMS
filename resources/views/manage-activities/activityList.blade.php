@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2><b>Upcoming KAFA Activity List</b></h2>
            </div>
            <div class="col-md-6 mt-4 d-flex justify-content-end align-items-center">
                <a href="{{ route('manage-activities.create') }}"><button type="button" class="btn"
                        style="background-color:#647687; color:white;">Add</button></a>
                <div class="form-group m-2">
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Activity Name</th>
                        <th>Activity Details</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $activity)
                        <tr style="height: 50px; vertical-align:middle;">
                            <td>{{ $activity->activityName }}</td>
                            <td>{{ $activity->activityDetails }}</td>
                            <td>{{ $activity->activityDate }}</td>
                            <td>{{ \Carbon\Carbon::parse($activity->startTime)->format('g:i A') }} to
                                {{ \Carbon\Carbon::parse($activity->endTime)->format('g:i A') }}</td>
                            <td>
                                <a><box-icon name='info-circle'></box-icon></a>
                                <a><box-icon type='solid' name='pencil'></box-icon></a>
                                <a><box-icon name='trash' type='solid'></box-icon></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex
                            justify-content-center">
            {{ $datas->links() }}
        </div>
    </div>
@endsection
