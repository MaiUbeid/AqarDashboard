@extends('admin_v2.layout.app')

@section('content')
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__body">
                <form method="post" action="{{$update_url}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $payment_request->id }}">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                            <div class="kt-form kt-form--label-right">
                                <div class="kt-form__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">


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

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('اسم المكتب')}} </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group validated">
                                                        <input readonly type="text" value="{{ $payment_request->user->name }}" name="name_ar" class="form-control" placeholder="{{ trans('views.name') }}">
                                                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('اسم المسؤول')}} </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group validated">
                                                        <input readonly type="text" value="{{ $payment_request->user->onwer_name }}" name="name_ar" class="form-control" placeholder="{{ trans('views.name') }}">
                                                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('views.email')}} </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group validated">
                                                        <input readonly type="text" value="{{ $payment_request->user->email }}" name="name_ar" class="form-control" placeholder="{{ trans('views.email') }}">
                                                        <div class="invalid-feedback">{{$errors->first('email')}}</div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('views.mobile')}} </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group validated">
                                                        <input readonly type="text" value="{{ $payment_request->user->mobile }}" name="name_ar" class="form-control" placeholder="{{ trans('views.mobile') }}">
                                                        <div class="invalid-feedback">{{$errors->first('mobile')}}</div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('views.payment_method_id')}}</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group validated">
                                                        <select id="payment_method_id" class="form-control" name="payment_method_id">
                                                            <option value="1">{{__('views.online')}}</option>
                                                            <option value="2">{{__('views.bank')}}</option>
                                                        </select>
                                                        <div class="invalid-feedback">{{$errors->first('payment_method_id')}}</div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="plans_div" style="display: none;" class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('views.plans')}}</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group validated">
                                                        <select class="form-control" name="plan">

                                                            @if($plans)
                                                                @foreach($plans as $plansItem)
                                                                    <option value="{{$plansItem->id}}">{{$plansItem->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="invalid-feedback">{{$errors->first('plan')}}</div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>

                                <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>

                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-xl-3"></div>
                                        <div class="col-lg-9 col-xl-6">
                                            <button class="btn btn-label-brand btn-bold" type="submit">{{__('views.Save Changes')}}</button>
                                            <a class="btn btn-clean btn-bold" href="{{$index_url}}">{{__('views.Cancel')}}</a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end:: Content -->


@endsection

@push('css')
@endpush


@push('scripts')
    <script>

      $('#payment_method_id').change(function () {
        // $(this).val() will work here
        if ($(this).val() == '2') {
          $('#plans_div').show();
        } else {
          $('#plans_div').hide();
        }
      });

      KTUtil.ready(function () {
        new KTAvatar('kt_user_avatar_1');
        new KTAvatar('kt_user_avatar_2');
      });
    </script>
@endpush
