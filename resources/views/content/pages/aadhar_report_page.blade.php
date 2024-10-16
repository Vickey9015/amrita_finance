@extends('layouts/contentNavbarLayout')

@section('title', 'Aadhaar Authentication - Aadhar Reports')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Aadhaar Authentication /</span> Report
</h4>


<!-- Hoverable Table rows -->
<div class="card">
  <h5 class="card-header">Aadhaar Authentications Report</h5>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Organisation</th>
          <th>Transaction Id</th>
          <th>User Referance Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Aadhaar No.</th>
          <th>Status</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <!-- 
      id] => 1
      [org_id] => 1
      [transaction_id] =>
      [user_ref_id] => AMR001UR0001
      [firstname] => vickey
      [lastname] => k
      [email] => d@gmail.com
      [phoneNumber] => 323425521
      [aadharno] => ******8868
      [status] => 0
      [created_at] => 2024-09-11 13:23:34
      [updated_at] => 2024-09-11 13:23:34 -->

      <tbody class="table-border-bottom-0">
        @foreach($aadhar_details as $adh_det)
        <tr>
          <td>{{ $adh_det->org_id }}</td>
          <td>{{ $adh_det->transaction_id }}</td>
          <td>{{ $adh_det->user_ref_id }}</td>
          <td>{{ $adh_det->firstname ." ".$adh_det->lastname }} </td>
          <td>{{ $adh_det->email }}</td>
          <td>{{ $adh_det->phoneNumber }}</td>
          <td>{{ $adh_det->aadharno }}</td>
          <td>
            <span class="badge rounded-pill bg-label-success me-1">Completed</span>
            <!-- <span class="badge rounded-pill bg-label-primary me-1">Active</span>
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