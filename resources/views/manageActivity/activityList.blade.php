@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2><b>Upcoming KAFA Activity List</b></h2>
            </div>
            <div class="col-md-6 mt-4 d-flex justify-content-end align-items-center">
                <!--Only authorised users can see ADD button -->
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'teacher')
                    <a href="{{ route('manageActivity.create') }}">
                        <button type="button" class="btn" style="background-color:#647687; color:white;">Add</button>
                    </a>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 20%">Activity Name</th>
                        <th style="width: 40%">Activity Details</th>
                        <th style="width: 15%">Date</th>
                        <th style="width: 15%">Time</th>
                        <th style="width: 10%">Actions</th>
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
                            <!--Change format to 12-hour format-->
                            <td>
                                <!--Accessible by all users-->
                                <a href="{{ route('manageActivity.show', ['manageActivity' => $activity['id']]) }}"><box-icon
                                        name='info-circle'></box-icon></a>
                                <!--Only accessed by staffs-->
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'teacher')
                                    <a href="{{ route('manageActivity.edit', ['manageActivity' => $activity['id']]) }}"><box-icon
                                            type='solid' name='pencil'></box-icon></a>

                                    <a href=#
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this activity?')) { document.getElementById('delete-form-{{ $activity->id }}').submit(); }">
                                        <box-icon name='trash' type='solid'></box-icon>
                                    </a>
                                    <form id="delete-form-{{ $activity->id }}"
                                        action="{{ route('manageActivity.destroy', ['manageActivity' => $activity->id]) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form> <!--Pop up alert for deletion -->
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex flex-row-reverse">
            {{ $datas->links('') }}
        </div>
    </div>

    <div style="position: fixed; left: 50%; transform: translate(-50%, -50%);">
        @if (session('failure'))
            <div class="alert alert-danger">
                {{ session('failure') }}
            </div>
        @endif <!--Red pop up message-->

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif <!--Green pop up message-->
    </div>
@endsection
   