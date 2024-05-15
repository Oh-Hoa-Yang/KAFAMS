@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-6">
        <h2><b>KAFA Teacher Accounts</b></h2>
      </div>
      <div class="d-flex justify-content-end align-items-center">
        <a href="{{ route('manageAccountRegistration.create') }}" class="btn btn-primary">Add</a>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Password</th>
              <th>Staff ID</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($datas as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->staffID }}</td>

                <td class="d-grid gap-2 d-md-block">

                  <button onclick="location.href='{{ route('manageAccountRegistration.edit', $user->id) }}'"
                    class="btn btn-info">
                    <i class="bi bi-pencil-fill"></i>
                  </button>

                  <form action="{{ route('manageAccountRegistration.destroy', $user->id) }}" class="d-inline-grid" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      </tbody>
      </table>
    </div>
  </div>
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
@endsection
