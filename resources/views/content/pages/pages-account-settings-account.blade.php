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
      <h4 class="card-header">Enter Aadhar Details</h4>
      <div class="card-body pt-2 mt-1">
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row mt-2 gy-4">
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" id="firstName" name="firstName" value="John" autofocus />
                <label for="firstName">First Name</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" name="lastName" id="lastName" value="Doe" />
                <label for="lastName">Last Name</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" id="email" name="email" value="john.doe@example.com" placeholder="john.doe@example.com" />
                <label for="email">E-mail</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="organization" name="organization" value="{{config('variables.creatorName')}}" />
                <label for="organization">Organization</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="202 555 0111" />
                  <label for="phoneNumber">Phone Number</label>
                </div>
                <span class="input-group-text">US (+1)</span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                <label for="address">Address</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" id="state" name="state" placeholder="California" />
                <label for="state">State</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" maxlength="6" />
                <label for="zipCode">Zip Code</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <select id="country" class="select2 form-select">
                  <option value="">Select</option>
                  <option value="Australia">Australia</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Belarus">Belarus</option>
                  <option value="Brazil">Brazil</option>
                  <option value="Canada">Canada</option>
                  <option value="China">China</option>
                  <option value="France">France</option>
                  <option value="Germany">Germany</option>
                  <option value="India">India</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="Israel">Israel</option>
                  <option value="Italy">Italy</option>
                  <option value="Japan">Japan</option>
                  <option value="Korea">Korea, Republic of</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Philippines">Philippines</option>
                  <option value="Russia">Russian Federation</option>
                  <option value="South Africa">South Africa</option>
                  <option value="Thailand">Thailand</option>
                  <option value="Turkey">Turkey</option>
                  <option value="Ukraine">Ukraine</option>
                  <option value="United Arab Emirates">United Arab Emirates</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="United States">United States</option>
                </select>
                <label for="country">Country</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <select id="language" class="select2 form-select">
                  <option value="">Select Language</option>
                  <option value="en">English</option>
                  <option value="fr">French</option>
                  <option value="de">German</option>
                  <option value="pt">Portuguese</option>
                </select>
                <label for="language">Language</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <select id="timeZones" class="select2 form-select">
                  <option value="">Select Timezone</option>
                  <option value="-12">(GMT-12:00) International Date Line West</option>
                  <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                  <option value="-10">(GMT-10:00) Hawaii</option>
                  <option value="-9">(GMT-09:00) Alaska</option>
                  <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                  <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                  <option value="-7">(GMT-07:00) Arizona</option>
                  <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                  <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                  <option value="-6">(GMT-06:00) Central America</option>
                  <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                  <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                  <option value="-6">(GMT-06:00) Saskatchewan</option>
                  <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                  <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                  <option value="-5">(GMT-05:00) Indiana (East)</option>
                  <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                  <option value="-4">(GMT-04:00) Caracas, La Paz</option>
                </select>
                <label for="timeZones">Timezone</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <select id="currency" class="select2 form-select">
                  <option value="">Select Currency</option>
                  <option value="usd">USD</option>
                  <option value="euro">Euro</option>
                  <option value="pound">Pound</option>
                  <option value="bitcoin">Bitcoin</option>
                </select>
                <label for="currency">Currency</label>
              </div>
            </div>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
