@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><b>Student Result</b></h2>
        </div>
        <div class="col-md-6 mt-4 d-flex justify-content-end align-items-center">
            <button class="btn btn-primary" style="background-color:#647687; color:white;" onclick="window.print()">Print</button>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-6">
            <h6>Student Name: {{ $student->studentName }}</h6>
            <h6>Class: {{ $student->className }}</h9>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 50%">Subject</th>
                    <th style="width: 25%">Marks</th>
                    <th style="width: 25%">Grades</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                <tr style="height: 50px; vertical-align:middle;">
                    <td>{{ $result->subjectName }}</td>
                    <td>{{ $result->resultMark }}</td>
                    <td>{{ $result->resultGrade }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-row-reverse">
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
