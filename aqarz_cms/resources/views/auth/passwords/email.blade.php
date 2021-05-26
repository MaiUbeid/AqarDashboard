@extends('app')


<style>
.navbar.navbar-inverse.navBar {
    display: none;
}
footer.subfooter ,footer.footer-main {
    display: none;
}
body {
    font-family: 'Cairo', sans-serif;
    background-color: #fff;
    background: url(../img/bk2.png) no-repeat center center #ffffff;
    background-size: cover;
}
section.section-footer {
    padding: 15px 0;
    position: absolute;
    bottom: 0;
}
body .card-form {
    background: #fff;
    margin: 9rem 30px;}
    @media (min-width: 1200px) {
           body .container{    width: 1170px;}
        }
        @media (min-width: 992px) and (max-width: 1169px) {
            body .container{    width: 970px;}
        }
        .has-feedback .form-control-feedback{    top: 31px !important;}
</style>

@section('title')
{{{ trans('auth.password_recover') }}} -
@stop

@section('content')

<!-- <div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site title-sm">{{{ trans('auth.password_recover') }}}</h1>
        <p class="subtitle-site"><strong>{{{$settings->title}}}</strong></p>
      </div>
    </div> -->

<div class="container">
	<div class="row">
		     <!-- Col MD -->
			 <div class="col-md-6">



</div><!-- /COL MD -->

<div class="col-md-5">
    <div class="card-form">
<div class="row title-imgs">
<div class="col-xs-6">
<img src="{{ asset('img/2-1.png') }}" class="logo logo1" />
</div>
<div class="col-xs-6">
    <a href="{{route('landPage')}}">
<img src="{{ asset('img/ARStock_dark.png') }}" class="logo logo2" />
    </a>
</div>
</div>



	<div class="login-form">
	<h3 class=" position-relative">{{{ trans('auth.password_recover') }}}</h3>
    <p> {{ trans('auth.Discover_the_best') }} </p>

		@if (session('status'))
						<div class="alert alert-success">
							{{{ session('status') }}}
						</div>
					@endif


		@include('errors.errors-forms')

          	<form action="{{{ url('/password/email') }}}" method="post" name="form" id="signup_form">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
			<label for="exampleInputEmail1">{{ trans('auth.Username_Email') }}</label>
              <input type="text" class="form-control login-field custom-rounded" name="email" id="email" placeholder="{{{ trans('auth.email') }}}" title="{{{ trans('auth.email') }}}" autocomplete="off">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
             </div>

           <button type="submit" id="buttonSubmit" class="btn btn-block btn-lg btn-main custom-rounded">{{{ trans('auth.send') }}}</button>
				<a href="{{{ route('login') }}}" class="text-center btn-block margin-top-10 back_btn"><i class="fa fa-long-arrow-left"></i> {{{ trans('auth.back') }}}</a>
          </form>
     </div><!-- Login Form -->

		</div><!-- col-md-12 -->
    </div><!-- row -->

</div><!-- container -->
@endsection

@section('javascript')
	<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

	<script type="text/javascript">

	$('#email').focus();

	 $('#buttonSubmit').click(function(){
    	$(this).css('display','none');
    	$('.back_btn').css('display','none');
    	$('<div class="btn-block text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw fa-loader"></i></div>').insertAfter('#signup_form');
    });

    @if (count($errors) > 0)
    	scrollElement('#dangerAlert');
    @endif

</script>
@endsection
