<style>
  div.error {
    color: red;
  }
</style>


@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Aadhar authentication /</span> Validation
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <section id="aadharDetailsSection">
        <h4 class="card-header">Enter Aadhar Details</h4>
        

        <div class="card-body pt-2 mt-1">
          <!-- <form id="formAadharDetails" method="POST" action="{{route('aadharvalidate')}}"> -->
          <form id="formAadharDetails">
            @csrf
            <div id="success-message" class="text-danger" style="display: none; font-weight:bold;"></div>
            <div class="row mt-2 gy-4">
              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" autofocus />
                  <label for="firstname">First Name</label>
                  <span class="text-danger error-message" id="firstname-error"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" />
                  <label for="lastname">Last Name</label>
                  <span class="text-danger error-message" id="lastname-error"></span>

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}" />
                  <span class="text-danger error-message" id="email-error"></span>
                  <label for="email">E-mail</label>
                  <!-- 
                @error("email")
                <div class="error">{{$message}}</div>
                @enderror -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="{{ old('phoneNumber') }}" />
                    <span class="text-danger error-message" id="phoneNumber-error"></span>
                    <label for="phoneNumber">Phone Number</label>
                    @error("phoneNumber")
                    <div class="error">{{$message}}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="text" id="aadharno" name="aadharno" class="form-control" value="{{ old('aadharno') }}" />
                    <span class="text-danger error-message" id="aadharno-error"></span>
                    <label for="aadharno">Aadhar Number</label>
                    @error("aadharno")
                    <div class="error">{{$message}}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-4">
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </form>
        </div>
      </section>
      <section id="sectionOtpSubmit" style="display: none;">
        <h4 class="card-header">Enter Otp</h4>
        <div class="card-body pt-2 mt-1">
          <!-- <form id="formAadharDetails" method="POST" action="{{route('aadharvalidate')}}"> -->
          <form id="formOtp">
            @csrf
            <div class="row mt-2 gy-4">
              <div class="col-md-6">
                <div id="success-message" style="display: none;"></div>
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" id="otp" name="otp" value="{{ old('otp') }}" placeholder="" autofocus />
                  <label for="otp">OTP</label>
                  <span class="text-danger error-message" id="otp-error"></span>
                </div>
              </div>



            </div>
            <div class="mt-4">
              <button type="submit" class="btn btn-primary me-2">Enter</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </form>
        </div>
      </section>








      <section id="uidi_aadhar_response_section" style="display: none;">
        <h4 class="card-header">Aadhar Verified Details</h4>
        <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />

        </div>
        <div style="margin-top: 20px;">Image of Aadhaar holder</div>
      </div>

        <div class="card-body pt-2 mt-1">
          <!-- <form id="formAadharDetails" method="POST" action="{{route('aadharvalidate')}}"> -->
          <form id="form_uidi_aadhar_response" style="margin-top: -35px;">
            @csrf
            <div id="success-message" class="text-danger" style="display: none; font-weight:bold;"></div>
            <div class="row mt-2 gy-4">
              <div class="col-md-6">

                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" value="Rahul Kumar" />
                  <label for="firstname">Full Name</label>


                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" value="Rakesh Singh" />
                  <label for="lastname">Care Of</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="text" value="Male" />
                  <label for="email">Gender</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" value="05-09-1999" />
                    <label for="email">D.O.B</label>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" value="9876 4324 9874" />
                    <label for="email">Aadhaar No.</label>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" value="Ward-4, Singhiya, Samastipur, Bihar, 848209" />
                    <label for="email">Address</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-4">
              <button type="submit" class="btn btn-primary me-2">Save As PDF</button>
              <!-- <button type="reset" class="btn btn-outline-secondary">Reset</button> -->
            </div>
            <!-- <div class="row">

							<a href="" onclick="makePdf()">
								<input type="button" id="" class="btn" style="background: #4285f4;
							 color: #fff;" value="Save As PDF">
							</a>

							<a href="">
									   <input type="button" id="" class="btn" style="background: #4285f4;
							 color: #fff; margin-left:255px" value="New Request">
								   </a>

						</div> -->
          </form>
        </div>
      </section>






      <!-- /Account -->
    </div>
  </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script type="text/javascript">
  $(document).ready(function() {

    $('#formAadharDetails').on('submit', function(e) {
      e.preventDefault(); // Prevent the form from submitting the normal way
      $.ajax({
        url: '{{ route("aadharvalidate") }}', // Your backend route 
        type: 'POST',
        data: $(this).serialize(), // Serialize the form data
        success: function(response) {
          $('#aadharDetailsSection').hide();
          $('#sectionOtpSubmit').show();
        },
        error: function(xhr, status, error) {
          $('#success-message').text('Error occured while submitting the form !').show();
          console.log(error); // Optionally log the error

          // Clear any previous error messages
          $('.error-message').text('');

          if (xhr.status === 422) {
            // Validation failed, display the validation errors
            var errors = xhr.responseJSON.errors;

            // Loop through the validation errors and display them
            $.each(errors, function(key, value) {
              $('#' + key + '-error').text(value[0]); // Show the first error for each field
            });
          } else {
            // Show other error messages
            $('#success-message').text('Error submitting form!').show();
            console.log(error);
          }
        }
      });
    });
  });
</script>






<script type="text/javascript">
  $(document).ready(function() {

    $('#formOtp').on('submit', function(e) {
      e.preventDefault(); // Prevent the form from submitting the normal way
      $.ajax({
        url: '{{ route("otp_verify") }}', // Your backend route 
        type: 'POST',
        data: $(this).serialize(), // Serialize the form data
        success: function(response) {
          $('#sectionOtpSubmit').hide();
          $('#uidi_aadhar_response_section').show();
        },
        error: function(xhr, status, error) {
          $('#success-message').text('Error occured while submitting the form !').show();
          console.log(error); // Optionally log the error

          // Clear any previous error messages
          $('.error-message').text('');

          if (xhr.status === 422) {
            // Validation failed, display the validation errors
            var errors = xhr.responseJSON.errors;

            // Loop through the validation errors and display them
            $.each(errors, function(key, value) {
              $('#' + key + '-error').text(value[0]); // Show the first error for each field
            });
          } else {
            // Show other error messages
            $('#success-message').text('Error submitting form!').show();
            console.log(error);
          }
        }
      });
    });
  });
</script>