@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>Upcoming Activity List</h2>
            </div>
            <div class="col-md-6 mt-4 d-flex justify-content-end align-items-center">
                <button type="button" class="btn" style="background-color:#647687; color:white;">Add</button>
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
                    <tr>
                        <td>Value 1</td>
                        <td>Value 2</td>
                        <td>Value 3</td>
                        <td>Value 4</td>
                        <td>Value 5</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
