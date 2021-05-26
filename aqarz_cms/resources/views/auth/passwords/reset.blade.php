@extends('app')

<style>
    header {
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.06);
}
.box-body {
    width: 100%;
    margin-left: 15px;
    margin-right: 15px;
}
</style>
@section('title'){{ trans('auth.reset_password').' - ' }}@endsection


@section('content')

<div class="container">
    <div class="row mt-70 mb-70">


        <!-- Col MD -->
        <div class="col-md-8 offset-md-2">
            <div class="icon-finished-looin text-center p-custome">
            <img src="{{ asset('img/reset.png') }}" class="sign-in mb-2">
            <h4 class="mb-5">
            {{ trans('auth.reset_password') }}
            </h4>
             <form action="{{ route('password.update') }}" method="POST" name="form" id="signup_form">
                <div class="row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="token" value="{{ $token }}" />

                            <br>
                            <br>

                            @include('errors.errors-forms')

                   <div class="col-md-12">

                    <div class="form-group has-feedback">
                        <label class="w-100">{{ trans('auth.email') }}</label>
                        <div class="input-with-gray">
                            <input type="text"
                                    class="form-control login-field custom-rounded"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    placeholder="{{ trans('auth.email') }}"
                                    title="{{ trans('auth.email') }}"
                                    autocomplete="off" />
                                    <i class="fal fa-envelope"></i>
                        </div>
                    </div>

                </div>

                   <div class="col-md-12">

                    <div class="form-group has-feedback">
                        <label class="w-100">{{ trans('auth.password') }}</label>
                        <div class="input-with-gray">
                            <input  type="password"
                                    class="form-control login-field custom-rounded"
                                    name="password"
                                    placeholder="{{ trans('auth.password') }}"
                                    title="{{ trans('auth.password') }}"
                                    autocomplete="off" />
                                    <i class="fal fa-unlock-alt"></i>
                        </div>
                    </div>

                </div>

                <div class="col-md-12">

                    <div class="form-group has-feedback">
                        <label class="w-100">{{ trans('auth.confirm_password') }}</label>
                        <div class="input-with-gray">
                            <input type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    placeholder="{{ trans('auth.confirm_password') }}"
                                    title="{{ trans('auth.confirm_password') }}"
                                    autocomplete="off" />
                                    <i class="fal fa-unlock-alt"></i>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 mt-3">
                   <button class="btn btn-primary btn-lg btn-block" type="submit"  id="buttonSubmit">{{ trans('auth.reset_password') }}</button>
                   </div>
                </div>
            </form>

            </div>


        </div>
        <!-- /COL MD -->


    </div>
    <!-- row -->
    <!-- container wrap-ui -->
</div>
@endsection
