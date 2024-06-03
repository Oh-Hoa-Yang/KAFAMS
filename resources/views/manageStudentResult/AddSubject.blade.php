@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2><b>Add Subject</b></h2>
            </div>
        </div>
        <form action="{{ route('manageStudentResult.storeNewSubject') }}" method="POST">
            @csrf
            <input type="hidden" name="subjectID" value="{{ request('subjectID') }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row m-3">
                        <label for="subjectName" class="col-sm-4 col-form-label">Subject Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="subjectName" name="subjectName">
                        </div>
                    </div>
                    
                    <div class="form-group row m-3">
                        <label for="subjectExamDate" class="col-sm-4 col-form-label">Examination Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="subjectExamDate" name="subjectExamDate">
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row justify-content-end">
                <div class="col-md-2">
                    <div class="text-right">
                        <button type="button" class="btn btn-outline-dark mr-2"
                            onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn" style="background-color:#647687; color:white;">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endsection