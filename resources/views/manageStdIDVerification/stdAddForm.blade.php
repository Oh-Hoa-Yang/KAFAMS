@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row mb-4">
      <div class="col text-center text-warning-emphasis">
        <h2 class="text-warning-emphasis"><b>KAFA Student Registration Form</b></h2>
        <hr>
        <hr>
        <hr>
      </div>
    </div>

    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card row d-flex justify-content-center align-items-center">
        <div class="col-md-6">
          <div class="form-group row m-3">
            <label for="stdName" class="col-sm-4 col-form-label">Student Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control @error('stdName') is-invalid @enderror" id="stdName" name="stdName" value="{{ old('stdName') }}">
              @error('stdName')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="form-group row m-3">
            <label for="motherIC" class="col-sm-4 col-form-label">Mother IC</label>
            <div class="col-sm-8">
              <input type="file" class="form-control @error('motherIC') is-invalid @enderror" id="motherIC" name="motherIC">
              @error('motherIC')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="form-group row m-3">
            <label for="fatherIC" class="col-sm-4 col-form-label">Father IC</label>
            <div class="col-sm-8">
              <input type="file" class="form-control @error('fatherIC') is-invalid @enderror" id="fatherIC" name="fatherIC">
              @error('fatherIC')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="form-group row m-3">
            <label for="stdIC" class="col-sm-4 col-form-label">Student IC</label>
            <div class="col-sm-8">
              <input type="file" class="form-control @error('stdIC') is-invalid @enderror" id="stdIC" name="stdIC">
              @error('stdIC')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="form-group row m-3">
            <label for="stdBirthCert" class="col-sm-4 col-form-label">Student Birth Certificate</label>
            <div class="col-sm-8">
              <input type="file" class="form-control @error('stdBirthCert') is-invalid @enderror" id="stdBirthCert" name="stdBirthCert">
              @error('stdBirthCert')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="form-group row m-3">
            <label for="role" class="col-sm-4 col-form-label">Role</label>
            <div class="col-sm-8">
              <select name="role" id="role" class="form-select @error('role') is-invalid @enderror"
                aria-label="role">
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
              </select>
              @error('role')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>


        </div>
        <br><br><br>
        <div class="row justify-content-center">
          <div class="col-md-2">
            <div class="col d-flex text-center m-4">
              <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">Cancel</button>
              <button type="submit" class="btn btn-primary ms-3">Submit</button>
            </div>
          </div>
        </div>
        <br><br>
      </div>
    </form>
  </div>
@endsection
