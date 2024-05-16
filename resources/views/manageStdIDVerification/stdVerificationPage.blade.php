@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-6">
        <h2><b>Student Identity Verification</b></h2>
      </div>
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
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($datas as $student)
            <tr>
              <td>{{ $student->stdName }}</td>
              <td>
                <a href="{{ asset('storage/' . $student->motherIC) }}" target="_blank" class="btn btn-info">View</a>
              </td>
              <td>
                <a href="{{ asset('storage/' . $student->fatherIC) }}" target="_blank" class="btn btn-info">View</a>
              </td>
              <td>
                <a href="{{ asset('storage/' . $student->stdIC) }}" target="_blank" class="btn btn-info">View</a>
              </td>
              <td>
                <a href="{{ asset('storage/' . $student->stdBirthCert) }}" target="_blank" class="btn btn-info">View</a>
              </td>
              <td
                class="
                        @if ($student->status == 'Pending') text-warning
                        @elseif($student->status == 'Approved') text-success 
                        @elseif($student->status == 'Rejected') text-danger @endif">
                <b>{{ $student->status }}</b>
              </td>
              <td>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                  data-student-id="{{ $student->id }}">Update Status</button>
                  <form action="{{ route('students.destroy',$student->id)}}" class="d-inline-grid" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                  </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

   <div style="position: fixed; left: 50%; transform: translate(-50%, -50%);)">
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

    <div class="d-flex justify-content-center">
      {{ $datas->links() }}
    </div>

    <!-- Update Status Modal -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('students.update', 'id') }}" method="POST" id="updateStatusForm">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="updateStatusModalLabel">Update Status</h5> 
              <button type="button"
                class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure this is the children of their parent?</p>
              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-select">
                  <option value="Approved">Approved</option>
                  <option value="Rejected">Rejected</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var updateStatusModal = document.getElementById('updateStatusModal');
      updateStatusModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var studentId = button.getAttribute('data-student-id');
        var form = document.getElementById('updateStatusForm');
        form.action = form.action.replace('id', studentId);
      });
    });
  </script>
@endsection
