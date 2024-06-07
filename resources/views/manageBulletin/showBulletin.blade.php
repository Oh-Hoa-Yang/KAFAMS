@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><b>KAFA bulletin</b></h2>
        </div>
        <div class="col-md-6 mt-4 d-flex justify-content-end align-items-center">
            <!--Only authorised users can see ADD and ARCHIVE button -->
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'teacher')
                <a href="{{ route('manageBulletin.newBulletin') }}">
                    <button type="button" class="btn" style="background-color:#647687; color:white; width:100px; margin-right: 10px;">Add</button>
                </a>
                <a href="{{ route('manageBulletin.archiveList') }}">
                    <button type="button" class="btn" style="background-color:#647687; color:white; width:100px;">Archive</button>
                </a>
            @endif
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ $category == 'General' ? 'active' : '' }}" href="{{ route('manageBulletin.bulletinList', ['category' => 'General']) }}">General</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $category == 'Academic' ? 'active' : '' }}" href="{{ route('manageBulletin.bulletinList', ['category' => 'Academic']) }}">Academic</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $category == 'Student Activity' ? 'active' : '' }}" href="{{ route('manageBulletin.bulletinList', ['category' => 'Student Activity']) }}">Student Activity</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $category == 'Others' ? 'active' : '' }}" href="{{ route('manageBulletin.bulletinList', ['category' => 'Others']) }}">Others</a>
        </li>
    </ul>

    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 100%">All Bulletins</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bulletins as $bulletin)
                <tr style="height: 50px; vertical-align:middle;">
                    <td>
                        <a href="{{ route('manageBulletin.viewBulletin', ['id' => $bulletin->id, 'category' => $category]) }}">
                            {{ $bulletin->bulletinTitle }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="text-align: right;">
        {{ $bulletins->links() }}
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
