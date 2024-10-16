@extends('layouts/blankLayout')

@section('title', 'Register')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection
<style>
  div.error {
    color: red;
  }
</style>



@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Register Card -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <!-- <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20])</span>
            <span class="app-brand-text demo text-heading fw-semibold">{{ config('variables.templateName') }}</span> -->
            <span class="app-brand-logo demo" style="font-weight: bold; font-size:40px;">Amrita Finance</span>
          </a>
        </div>
        <!-- /Logo -->
        <div class="card-body mt-2">
          <h4 class="mb-2">Organisation Register</h4>
          <p class="mb-4">Let's Start !</p>
          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif

          <form id="formAuthentication" class="mb-3" action="{{url('register')}}" method="post">
            @csrf
            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" name="org_name" autofocus>
              @error("org_name")
              <div class="error">{{$message}}</div>
              @enderror
              <label for="org_name">Organisation Name</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" name="org_email" placeholder="Enter your email">
              @error("org_email")
              <div class="error">{{$message}}</div>
              @enderror
              <label for="org_email">Email</label>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="password" id="password" class="form-control" name="password" autocomplete="off" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  @error("password")
                  <div class="error">{{$message}}</div>
                  @enderror
                  <label for="password">Password</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
              </div>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="password" id="re_password" class="form-control" name="re_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="re_password" />
                  @error("re_password")
                  <div class="error">{{$message}}</div>
                  @enderror
                  <label for="re_password">Re-Password</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                <label class="form-check-label" for="terms-conditions">
                  I agree to
                  <a href="javascript:void(0);">privacy policy & terms</a>
                </label>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100">
              Register
            </button>
          </form>

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{url('organisation-login')}}">
              <span>Log in instead</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
      <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
      <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}" class="authentication-image d-none d-lg-block" alt="triangle-bg">
      <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
    </div>
  </div>
</div>
@endsection