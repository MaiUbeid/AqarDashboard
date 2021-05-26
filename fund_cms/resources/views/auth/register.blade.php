@extends('app')



@section('title'){{ trans('auth.sign_up').' - ' }}@endsection

  @section('css')
  <link href="{{ asset('plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <style>
      html[lang="ar"] body .card-form {    background: #fff;
          margin: 3rem 30px 2rem;}
      html[lang="ar"] .navbar.navbar-inverse.navBar {
          display: none;
      }
      html[lang="ar"] footer.subfooter ,footer.footer-main {
          display: none;
      }
      html[lang="ar"] body {
          font-family: 'Cairo', sans-serif;
          background-color: #fff;
          background: url(./img/bk1.png) no-repeat center center #ffffff;
          background-size: cover;
      }
      html[lang="ar"] body .title-imgs {
          padding: 2rem 4rem 0;
      }




      html[lang="en"] body .card-form {    background: #fff;
          margin: 3rem 30px 2rem;}
      html[lang="en"] .navbar.navbar-inverse.navBar {
          display: none;
      }
      html[lang="en"] footer.subfooter ,footer.footer-main {
          display: none;
      }
      html[lang="en"] body {
          font-family: 'Cairo', sans-serif;
          background-color: #fff;
          background: url(./img/bk1.png) no-repeat center center #ffffff;
          background-size: cover;
      }
      html[lang="en"] body .title-imgs {
          padding: 2rem 4rem 0;
      }
      @media (min-width: 320px) and (max-width: 767px) {
          .container.register-page{ background: url(./img/bk1.png) no-repeat center center #ffffff;
          background-size: cover;}
        .container {
    padding-right: 7px !important;
    padding-left: 7px !important;}
        div#rc-anchor-container {
    width: 99% !important;
}
        body div#html_element .rc-anchor-normal {
        width: auto !important;
    }
    body div#html_element .rc-anchor-logo-portrait {
        margin: 10px 0px 0 0 !important;}
        body div#html_element .rc-anchor-normal .rc-anchor-pt {
            margin: 2px 0 0 23px !important;}
            body div#html_element div#html_element div:first-child {
                width: 100% !important;
            }
        }

  </style>
  @endsection

@section('content')

<!-- <div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site title-sm">{{ trans('auth.sign_up') }}</h1>
        <p class="subtitle-site"><strong>{{$settings->title}}</strong></p>
      </div>
    </div> -->

<div class="container register-page">

	<div class="row">
<!-- Col MD -->

 <!-- Col MD -->
<div class="col-md-6">


</div><!-- /COL MD -->

<div class="col-md-5 content-regester">

	<div class="card-form">
<div class="row title-imgs">
<div class="col-xs-6">
<img src="{{ asset('img/1-2.png') }}" class="logo logo1" />
</div>
<div class="col-xs-6">
    <a href="{{url('home')}}">
<img src="{{ asset('img/ARStock_dark.png') }}" class="logo logo2" />
    </a>
</div>
</div>
	<div class="login-form">
	<h3 class=" position-relative">{{ trans('auth.sign_up') }}</h3>
                <p> {{ trans('auth.Discover_the_best') }} </p>
		@if (session('notification'))
						<div class="alert alert-success text-center">

							<div class="btn-block text-center margin-bottom-10">
								<i class="glyphicon glyphicon-ok ico_success_cicle"></i>
								</div>

							{{ session('notification') }}
						</div>
					@endif

		@include('errors.errors-forms')

          	<form action="{{ url('register') }}" method="post" name="form" id="signup_form">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

             <!-- FORM GROUP -->
            <div class="form-group has-feedback">
              <input  type="text"
					 oninvalid="setCustomValidity('{{trans('validation.fullname')}}')"
					 oninput="setCustomValidity('')"
					 required class="form-control login-field custom-rounded" value="{{ old('username') }}" name="username" placeholder="{{ trans('auth.username') }}" title="sssss" autocomplete="off">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div><!-- ./FORM GROUP -->

             <!-- FORM GROUP -->
            <div class="form-group has-feedback">
              <input type="email"
					 oninvalid="setCustomValidity('{{trans('validation.email')}}')"
					 oninput="setCustomValidity('')"
					 required
				 class="form-control login-field custom-rounded" value="{{ old('email') }}" name="email" placeholder="{{ trans('auth.email') }}" title="{{ trans('auth.email') }}" autocomplete="off">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div><!-- ./FORM GROUP -->

         <!-- FORM GROUP -->
         <div class="form-group has-feedback">
              <input type="password"
					 oninvalid="setCustomValidity('{{trans('validation.password')}}')"
					 oninput="setCustomValidity('')"
					 required
					  class="form-control login-field custom-rounded" name="password" placeholder="{{ trans('auth.password') }}" title="{{ trans('auth.password') }}" autocomplete="off">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         </div><!-- ./FORM GROUP -->

         <div class="form-group has-feedback">
			<input type="password"
				   oninvalid="setCustomValidity('{{trans('validation.attributes.password_confirmation')}}')"
				   oninput="setCustomValidity('')"
				   required
				   class="form-control" name="password_confirmation" placeholder="{{ trans('auth.confirm_password') }}" title="{{ trans('auth.confirm_password') }}" autocomplete="off">
			<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
		</div>

		@if( $settings->captcha == 'on' )
					<script type="text/javascript">
                        var onloadCallback = function() {
                            grecaptcha.render('html_element', {
                                'sitekey' : '{{env('GOOGLE_RECAPTCHA_KEY')}}'
                            });
                        };
					</script>
					<div id="html_element"></div>


					{{--<div class="g-recaptcha"--}}
						 {{--data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">--}}
					{{--</div>--}}
					<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
							async defer>
					</script>


				@endif

      <div class="row margin-bottom-15">
        	<div class="col-xs-12">
        		<div class="checkbox icheck margin-zero">
   				<label class="margin-zero">
   					<input title="Lütfen işaretli yerleri doldurunuz"
                           required data-required-message="{{trans('validation.required')}}"
                           @if( old('agree_gdpr') ) checked="checked" @endif class="no-show"
                           name="agree_gdpr" type="checkbox" value="1"
                           oninvalid="setCustomValidity('{{trans('validation.agree_gdpr')}}')"
                           onchange="setCustomValidity('')"
                    >
   					<span class="keep-login-title">{{ trans('admin.i_agree_gdpr') }}</span>
            @if($settings->link_privacy != '')
              <a href="{{$settings->link_privacy}}" target="_blank" style="display: block;">{{ trans('admin.privacy_policy') }}</a>
            @endif
   			</label>
   		</div>
        	</div>
        </div><!-- row -->
		<div class="btn-group-login">
           <button type="submit" id="buttonSubmitRegister" class="btn btn-block btn-lg btn-main custom-rounded">{{ trans('auth.sign_up') }}</button>



		 <div class="social-btn-group">

@if( $settings->facebook_login == 'on' )
	<div class="facebook-login auth-social" id="twitter-btn">
		<a href="{{ url('/auth/redirect/facebook')}}" class="btn btn-block facebook custom-rounded"><i class="fab fa-facebook"></i> </a>
	</div>
@endif

@if( $settings->twitter_login == 'on')
	<div class="facebook-login auth-social" id="twitter-btn">
		<a href="{{url('oauth/twitter')}}" class="btn btn-block twitter custom-rounded"><i class="fab fa-twitter"></i> </a>
	</div>
@endif
</div>
							 </div>
		  </form>
		  <div class="btn-block text-center new-account-text">
                    <p>{{ Lang::get('auth.already_have_an_account') }} <a href="{{ route('login') }}" class="">{{ trans('auth.login') }}</a></p>

					</div>


     </div><!-- Login Form -->

 </div><!-- /COL MD -->

</div><!-- ROW -->
<section class="section-footer">
<div class="container">
    <div class="row">
        <div class="col-md-6">	<p>©{{trans('global.copy')}}©</p></div>
        <div class="col-md-6">
            <ul class="footer-login">
                @foreach( App\Models\Pages::all() as $page )
                    @if($page->slug === 'privacy')
                        <li><a class="link-footer" href="{{ url('/'.$page->slug) }}">
                    @else
                        <li><a class="link-footer" href="{{ url('page.show',$page->slug) }}">
                                @endif
                                @if(App::isLocale('en'))
                                    {{ $page->title_en }}
                                @else
                                    {{ $page->title_ar }}
                                @endif
                            </a>
                        </li>
                        @endforeach
            </ul>
        </div>
    </div>
    </div>
</section>
 </div><!-- row -->

 <!-- container wrap-ui -->

@endsection

@section('javascript')

  <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

	<script type="text/javascript">



 @if( $settings->captcha == 'on' )
/*
 *  ==============================================  Captcha  ============================== * /
 */


 window.onload = function() {
     var $recaptcha = document.querySelector('#html_element');

     if($recaptcha) {
         $recaptcha.setAttribute("required", "required");
     }
 };

    @else

	$('#buttonSubmitRegister').click(function(){
		$('.wrap-loader').show();
    	$(this).css('display','none');
    	$('.auth-social').css('display','none');
    	$('<div class="btn-block text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw fa-loader"></i></div>').insertAfter('#signup_form');
    });

    @endif

    @if (count($errors) > 0)
    	scrollElement('#dangerAlert');
    @endif

    @if (session('notification'))
    	$('#signup_form, #dangerAlert').remove();
    @endif

    $(document).ready(function(){
  	  $('input').iCheck({
  	  	checkboxClass: 'icheckbox_square-red',
  	  });
  	});

</script>


@endsection
