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
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 30%">Title</th>
                        <th style="width: 20%">Category</th>
                        <th style="width: 40%">Message</th>
                        <th style="width: 20%">Posted</th>
                        <th style="width: 20%">Last update</th>
                        <th style="width: 10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $bulletin)
                        <tr style="height: 50px; vertical-align:middle;">
                            <td>{{ $bulletin->bulletinTitle }}</td>
                            <td>{{ $bulletin->bulletinCategory }}</td>
                            <td>{{ $bulletin->bulletinMessage }}</td>
                            <td>{{ $bulletin->created_at }}</td>
                            <td>{{ $bulletin->updated_at }}</td>
                            <td>
                                <!--Only accessed by staffs-->
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'teacher')
                                    <a href="{{ route('manageBulletin.editBulletin', ['manageBulletin' => $bulletin['id']]) }}"><box-icon
                                            type='solid' name='pencil'></box-icon></a>

                                    <a href=#
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this bulletin?')) { document.getElementById('delete-form-{{ $bulletin->id }}').submit(); }">
                                        <box-icon name='trash' type='solid'></box-icon>
                                    </a>
                                    <form id="delete-form-{{ $bulletin->id }}"
                                        action="{{ route('manageBulletin.deleteBulletin', ['manageBulletin' => $bulletin->id]) }}"
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