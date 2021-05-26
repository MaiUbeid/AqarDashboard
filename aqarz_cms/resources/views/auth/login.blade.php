@extends('app')

<style>
    header {
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.06);
}
</style>
@section('title'){{ trans('auth.login').' - ' }}@endsection @section('css')
<link href="{{ asset('plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
@endsection @section('content')

<!-- <div class="jumbotron md index-header jumbotron_set jumbotron-cover">
        <div class="container wrap-jumbotron position-relative">
            <h1 class="title-site title-sm">{{ trans('auth.login') }}</h1>
            <p class="subtitle-site"><strong>{{$settings->title}}</strong></p>
        </div>
    </div> -->

<div class="container">
    <div class="row mt-70 mb-70">


        @if( $settings->registration_active == 1 )
        <!-- Col MD -->
        <div class="col-md-8 offset-md-2">
            <div class="icon-finished-looin text-center p-150">
            <img src="{{ asset('img/sign-in.png') }}" class="sign-in mb-4">
            <h4 class="mb-3">
            {{ trans('global.Session-finished-Log-in-again') }}
            </h4>
            <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#login">{{ trans('auth.login') }}</button>
            </div>


        </div>
        <!-- /COL MD -->
        @endif


    </div>
    <!-- row -->
    <!-- container wrap-ui -->
</div>
@endsection @section('javascript')
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

<script type="text/javascript">

    // $('#email').focus();

    // $('#buttonSubmitii').click(function () {
    //   $(this).css('display', 'none');
    //   $('.auth-social').css('display', 'none');
    //   $('<div class="btn-block text-center"><i class="fal fa-cog fa-spin fa-3x fa-fw fa-loader"></i></div>').insertAfter('#
    _form');
    // });


    // $(document).ready(function () {

      // $('#buttonSubmit').click(function(e){
      //      if(!$(this).parent('form').find('#email').val() || !$(this).parent('form').find('#password').val())   {
      //    //  e.stopPropagation();

      //       }
      //     else{
      //    alert('ssfgr');
      //    return false;
      //    }
      // });

      // $('form').submit(function(e){
      //        alert('submit');
      //        return false;
      //    });

    //   $('input').iCheck({
    //     checkboxClass: 'icheckbox_square-red',
    //     radioClass: 'iradio_square-red',
    //   });
    // });

    // @if (count($errors) > 0)
    // scrollElement('#dangerAlert');
    //   @endif
</script>
@endsection
