<!DOCTYPE html>

<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>{{__('views.fund')}}</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->
    <!--begin::Page Custom Styles(used by this page) -->

    <link href="{{asset('admin_assets/css/pages/login/login-3.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->

    <link href="{{asset('admin_assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('admin_assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->



    <link href="{{asset('admin_assets/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin_assets/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin_assets/css/skins/brand/dark.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin_assets/css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css"/>

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{asset('media/bg/bg-3.jpg')}});">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <img src="{{url('img/logo.png')}}" class="img-fluid">
                        </a>
                    </div>
                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">الدخول للوحة التحكم</h3>
                        </div>

                        <form class="kt-form" method="POST" action="{{ route('sendLoginAdmin') }}">
                            {{ csrf_field() }}


                            @if ($errors->any())
                                <div class="alert alert-solid-danger alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">
                                    <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="alert-text">{{__('views.Oops, something went wrong! Please check the errors below.')}}
                                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                                    </div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                            @endif



                            <div class="input-group">
                                <input required class="form-control" type="text" placeholder="{{__('views.email')}}" name="email" autocomplete="off">
                            </div>
                            <div class="input-group">
                                <input required class="form-control" type="password" placeholder="{{__('views.password')}}" name="password">
                            </div>
                            <div class="row kt-login__extra">
                                <div class="col">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('views.Remember_Me') }}
                                        </label>
                                        <span>

                                        </span>
                                    </label>
                                </div>
                                <div class="col kt-align-right">
                                    @if (Route::has('password.request'))
                                        <a id="kt_login_forgot" class="kt-login__link" class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif

                                </div>
                            </div>
                            <div class="kt-login__actions">
                                <button type="submit" id="kt_login_signin_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Sign In</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
  var KTAppOptions = {
    "colors": {
      "state": {
        "brand": "#5d78ff",
        "dark": "#282a3c",
        "light": "#ffffff",
        "primary": "#5867dd",
        "success": "#34bfa3",
        "info": "#36a3f7",
        "warning": "#ffb822",
        "danger": "#fd3995"
      },
      "base": {
        "label": [
          "#c5cbe3",
          "#a1a8c3",
          "#3d4465",
          "#3e4466"
        ],
        "shape": [
          "#f0f3ff",
          "#d9dffa",
          "#afb4d4",
          "#646c9a"
        ]
      }
    }
  };
</script>

<!-- end::Global Config -->



<script src="{{asset('admin_assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('admin_assets/js/scripts.bundle.js')}}" type="text/javascript"></script>

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
