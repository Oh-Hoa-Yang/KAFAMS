@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-6">
        <h2><b>KAFA Student Registration -- Children</b></h2>
      </div>
      <div class="d-flex justify-content-end align-items-center">
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add</a>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Mother IC</th>
              <th>Father IC</th>
              <th>Student IC</th>
              <th>Birth Certificate</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($datas as $student)
              <tr>
                <td>{{ $student->stdName }}</td>
                <td>
                  <a href="{{ asset('storage/'.$student->motherIC) }}" target="_blank" class="btn btn-info">View</a>
                </td>
                <td>
                  <a href="{{ asset('storage/'.$student->fatherIC) }}" target="_blank" class="btn btn-info">View</a>
                </td>
                <td>
                  <a href="{{ asset('storage/'.$student->stdIC) }}" target="_blank" class="btn btn-info">View</a>
                </td>
                <td>
                  <a href="{{ asset('storage/'.$student->stdBirthCert) }}" target="_blank" class="btn btn-info">View</a>
                </td>
                <td class="
                    @if ($student->status == 'Pending') text-warning
                    @elseif($student->status == 'Approved') text-success 
                    @elseif($student->status == 'Rejected') text-danger @endif">
                  <b>{{ $student->status }}</b>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div style="position: fixed; left: 50%; transform: translate(-50%, -50%);">
      @if (session('failure'))
        <div class="alert alert-danger">
          {{ session('failure') }}
        </div>
      @endif

      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif
    </div>

    <div class="d-flex justify-content-center">
      {{ $datas->links() }}
    </div>
  </div>
@endsection
