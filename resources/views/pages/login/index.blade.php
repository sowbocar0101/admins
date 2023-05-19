{{-- ====A+P+P+K+E+Y==== --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('admin/vendors/iconfonts/ti-icons/css/themify-icons.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  @yield('css')
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/style-custom.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('images/logo.png')}}" />
</head>

<body>
  <div class="container-scroller login-page">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="main-panel">
        <div style="background-color:white;" class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                    <h1 class="text-center new-text-aqua-color font-weight-bold">@lang('default.new.login.title')</h1>
                </div>
                <h4 class="text-center new-text">@lang('default.login.welcome')</h4>
                {{--  <h6 class="font-weight-light">@lang('default.login.info')</h6>  --}}
                <form class="pt-3" action="" method="POST">
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ session()->get('error') }}.
                    </div>
                @endif
                  @csrf
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" style="border-radius: 5px;" name="username" id="exampleInputEmail1" placeholder="@lang('default.table.username')" required>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" style="border-radius: 5px;" name="password" id="exampleInputPassword1" placeholder="@lang('default.table.password')" required>
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-lg font-weight-medium auth-form-btn new-button new-button-color-login">@lang('default.login.buttonlogin')</button>
                  </div>
                </form>
              </div>
              <div class="text-center">

                  <a href="switch=id" style="display: inline-block;margin: 10px;"><img src="{{asset('images/indonesia.svg')}}" alt="" srcset="" style="width: 30px;border-radius: 0px;"></a>
                  <a href="switch=en" style="display: inline-block;margin: 10px;"><img src="{{asset('images/united-kingdom.svg')}}" alt="" srcset="" style="width: 30px;border-radius: 0px;"></a>
                  <a href="switch=jp" style="display: inline-block;margin: 10px;"><img src="{{asset('images/japan.svg')}}" alt="" srcset="" style="width: 30px;border-radius: 0px;"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- build:js -->
  <script>
      document.addEventListener("DOMContentLoaded", function() {
            var elements = document.getElementsByTagName("INPUT");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity("@lang('default.validation.required')");
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }
        })
  </script>
  <!-- build:js -->
  <!-- endinject -->
</body>

</html>
