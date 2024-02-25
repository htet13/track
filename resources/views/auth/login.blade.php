@extends('auth.layouts.app')

@section('content')
<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="card mb-3">

              <div class="card-body">
                <div class="pt-4 pb-2">
                  @if($errors->has('email'))
                  <div class="text-center text-white bg-danger">
                    {{ $errors->first('email') }}
                  </div>
                  @endif
                  <h5 class="card-title text-center pb-0 fs-4">စနစ်သို့ ဝင်ရောက်ခြင်း</h5>
                </div>

                <form class="row g-3 needs-validation" action="{{ route('login') }}" method="POST" novalidate>
                  @csrf
                  <div class="col-12">
                    <label for="email" class="form-label">{{ trans('global.email') }}</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend"><i class="ri-mail-fill"></i></span>
                      <input type="email" name="email" class="form-control" id="email" required>
                      <div class="invalid-feedback">Please enter your email.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      <input name="password" type="password" value="" class="form-control" id="password" placeholder="password" required="true">
                      <span class="input-group-text" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                      </span>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">အကောင့် မှတ်သားမည်။</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit" onclick="lsRememberMe()">{{ trans('global.login') }}</button>
                  </div>
                  <!-- <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="#">Create an account</a></p>
                    </div> -->
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

  </div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</main><!-- End #main -->
@endsection

@section('scripts')
<script>
  const rmCheck = document.getElementById("rememberMe"),
    emailInput = document.getElementById("email"),
    passwordInput = document.getElementById('password');

  if (localStorage.checkbox && localStorage.checkbox !== "") {
    rmCheck.setAttribute("checked", "checked");
    emailInput.value = localStorage.email;
    passwordInput.value = localStorage.password;
  } else {
    rmCheck.removeAttribute("checked");
    emailInput.value = "";
    passwordInput.value = "";
  }

  function lsRememberMe() {
    if (rmCheck.checked && emailInput.value !== "") {
      localStorage.email = emailInput.value;
      localStorage.checkbox = rmCheck.value;
      localStorage.password = passwordInput.value;
    } else {
      localStorage.email = "";
      localStorage.password = "";
      localStorage.checkbox = "";
    }
  }

  function password_show_hide() {
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
      x.type = "text";
      show_eye.style.display = "none";
      hide_eye.style.display = "block";
    } else {
      x.type = "password";
      show_eye.style.display = "block";
      hide_eye.style.display = "none";

    }
  }
</script>
@endsection