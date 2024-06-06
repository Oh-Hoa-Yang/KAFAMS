@extends('layouts.app')
@if (auth()->user()->role != 'admin' && auth()->user()->role != 'teacher')
    {{ abort(403, 'Unauthorized action.') }}
@endif
@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2><b>Edit Bulletin</b></h2>
            </div>
        </div>
        <form action="{{ route('manageBulletin.updateBulletin', ['manageBulletin' => $bulletin['id']]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                <div class="form-group row m-3">
                    <label for="bulletinCategory" class="col-sm-4 col-form-label">Category</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="bulletin_Category" name="bulletinCategory">
                            <option value="" disabled {{ empty($bulletin->bulletinCategory) ? 'selected' : '' }}>Please choose</option>
                            <option value="general" {{ $bulletin->bulletinCategory == 'general' ? 'selected' : '' }}>General</option>
                            <option value="academic" {{ $bulletin->bulletinCategory == 'academic' ? 'selected' : '' }}>Academic</option>
                            <option value="studentActivity" {{ $bulletin->bulletinCategory == 'studentActivity' ? 'selected' : '' }}>Student Activity</option>
                            <option value="others" {{ $bulletin->bulletinCategory == 'others' ? 'selected' : '' }}>Others</option>
                        </select>
                    </div>
                </div>
                    
                    <div class="form-group row m-3">
                        <label for="bulletinTitle" class="col-sm-4 col-form-label">Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="bulletin_title" name="bulletinTitle"
                                value="{{ $bulletin['bulletinTitle'] }}">
                        </div>
                    </div>
                    <div class="form-group row m-3">
                        <label for="bulletinMessage" class="col-sm-4 col-form-label">Message</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="bulletin_message" name="bulletinMessage" rows="4">{{ $bulletin['bulletinMessage'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-2">
                    <div class="text-right">
                        <button type="button" class="btn btn-outline-dark mr-2"
                            onclick="window.history.back()">Cancel</button>
                        <!--Save into db/calls update() -->
                        <button type="submit" class="btn" style="background-color:#647687; color:white;">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection