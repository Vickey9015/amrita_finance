@extends('layouts/contentNavbarLayout')


@section('title', 'Users Management - Users')


@section('content')

<style>
  #container {
    display: flex;
    justify-content: space-between;
  }
</style>
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Users Management /</span> Report
</h4>


<!-- Hoverable Table rows -->
<div class="card">

  <div class="card-header" id="container">
    <div>
      <h5>Users Detail</h5>
    </div>
    <div>
      <!-- <button type="button" class="btn btn-primary">Add New User +</button> -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
        Add New User
      </button>

    </div>
  </div>



  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Organisation</th>
          <!-- <th>Transaction Id</th> -->
          <th>User Referance Id</th>
          <th>Name</th>
          <th>Email</th>
          <!-- <th>Phone Number</th> -->
          <!-- <th>Aadhaar No.</th> -->
          <th>Status</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @foreach($user_details as $adh_det)
        <tr>
          <td>{{ $adh_det->org_id }}</td>
          <!-- <td>{{ $adh_det->transaction_id }}</td> -->
          <td>{{ $adh_det->user_ref_id }}</td>
          <td>{{ $adh_det->name}} </td>
          <td>{{ $adh_det->email }}</td>
          <!-- <td>{{ $adh_det->phoneNumber }}</td> -->
          <!-- <td>{{ $adh_det->aadharno }}</td> -->
          <td>

            <span class="badge rounded-pill bg-label-primary me-1">Active</span>

            <!-- <span class="badge rounded-pill bg-label-success me-1">Completed</span>
            <span class="badge rounded-pill bg-label-info me-1">Scheduled</span>
            <span class="badge rounded-pill bg-label-warning me-1">Pending</span> -->
          </td>
          <td>{{ $adh_det->created_at }}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="mdi mdi-trash-can-outline me-1"></i> Delete</a>
              </div>
            </div>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>
<!--/ Hoverable Table rows -->


@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@if (count($errors) > 0)
<script type="text/javascript">
  $(document).ready(function() {


    
    $('#basicModal').modal('show');

  });
</script>
@endif

<!-- Modal -->
<!-- <div class="modal fade show" id="basicModal" tabindex="-1" aria-hidden="true" role="dialog" style="display:block;"> -->

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel1">Add User</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('addUser')}}" method="post" >
        @csrf


        <div class="modal-body">
          <div class="row">
            <div class="col mb-4 mt-2">
              <div class="form-floating form-floating-outline">
                <input type="text" name="name" class="form-control" placeholder="Enter Name">
                @error("name")
                <div class="error">{{$message}}</div>
                @enderror


                <label for="name">Name</label>
              </div>
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <div class="form-floating form-floating-outline">
                <input type="email" name="email" class="form-control" placeholder="xxxx@xxx.xx" >
                @error("email")
                <div class="error">{{$message}}</div>
                @enderror
                <label for="email">Email</label>
              </div>
            </div>
            <div class="col mb-2">
              <div class="form-floating form-floating-outline">
                <input type="text" name="phone" class="form-control" placeholder="Enter Phone" >
                @error("phone")
                <div class="error">{{$message}}</div>
                @enderror
                <label for="phone">Phone</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-4 mt-2">
              <div class="form-floating form-floating-outline">
                <input type="password" name="password" class="form-control" placeholder="Enter Passsword" autocomplete="new-password">
                @error("password")
                <div class="error">{{$message}}</div>
                @enderror
                <label for="password">Password</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>



    </div>
  </div>
</div>
</div>
</div>





