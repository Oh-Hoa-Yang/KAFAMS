@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2><b>List of archive bulletin</b></h2>
            </div>
            <div class="col-md-6 mt-4 d-flex justify-content-end align-items-center">
                <!--Only authorised users can see ADD and ARCHIVE button -->
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'teacher')
                    <a href="{{ route('manageBulletin.newBulletin') }}">
                        <button type="button" class="btn" style="background-color:#647687; color:white;">Add</button>
                    </a>
                    <a href="{{ route('manageBulletin.archiveList') }}">
                        <button type="button" class="btn" style="background-color:#647687; color:white;">Archive</button>
                    </a>
                @endif
            </div>
        </div>
        <div class="">







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