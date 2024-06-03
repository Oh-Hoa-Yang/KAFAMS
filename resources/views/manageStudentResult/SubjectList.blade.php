@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><b>Subject List</b></h2>
        </div>
        <div class="col-md-6 mt-4 d-flex justify-content-end align-items-center">
            <!--Only authorised users can see ADD button -->
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'teacher')
            <a href="{{ route('manageStudentResult.newSubject') }}">
                <button type="button" class="btn" style="background-color:#647687; color:white;">Add New Subject</button>
            </a>
            @endif
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 40%">Subject</th>
                    <th style="width: 40%">Examination Date</th>
                    <th style="width: 20%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subjects)
                <tr style="height: 50px; vertical-align:middle;">
                    <td>{{ $subjects->subjectName }}</td>
                    <td>{{ $subjects->subjectExamDate }}</td>

                    <td>

                        <!--Only accessed by staffs-->
                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'teacher')

                        <a href="{{ route('manageStudentResult.viewStudentList', ['subjectID' => $subjects->subjectID]) }}"><box-icon type='solid' name='user-plus'></box-icon></a>

                        <a href="{{ route('manageStudentResult.editResult', ['subjectID' => $subjects->subjectID]) }}"><box-icon type='solid' name='pencil'></box-icon></a>
                        
                        <a href=# onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this subject?')) { document.getElementById('delete-form-{{ $subjects->subjectID }}').submit(); }">
                            <box-icon name='trash' type='solid'></box-icon>
                        </a>
                        <form id="delete-form-{{ $subjects->subjectID }}" action="{{ route('manageStudentResult.deleteSubject', ['id' => $subjects->subjectID]) }}" method="POST" style="display: none;">
                         method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form><!--Pop up alert for deletion -->
                        @endif
                    </td>
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