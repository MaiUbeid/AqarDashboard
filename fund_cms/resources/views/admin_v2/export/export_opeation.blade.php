@extends('admin_v2.layout.app')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success btn-sm alert-fonts" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('incorrect_pass'))
        <div class="alert alert-danger btn-sm alert-fonts" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('incorrect_pass') }}
        </div>
    @endif


    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__body">
                <form method="post" action="{{route('admin.settings.export_fund_operation')}}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
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
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('حالة الطلبات')}}</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group validated">
                                                            <select class="form-control" name="type" id="">
                                                                <option value="">اختر النوع</option>
                                                                <option value="all">جميع الطلبات</option>
                                                                <option value="1">طلبات ناجحة</option>
                                                                <option value="0"> طلبات فشلت</option>
                                                            </select>
                                                            <div class="invalid-feedback">{{$errors->first('type')}}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-6 ">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('التاريخ من')}}</label>
                                                    <div class="col-lg-6 ">
                                                        <div class="input-group validated">
                                                            <input  type="date"  name="from_date" class="form-control" placeholder="">

                                                            <div class="invalid-feedback">{{$errors->first('date')}}</div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-6 ">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('التاريخ الي')}}</label>
                                                        <div class="col-lg-6 ">
                                                            <div class="input-group validated">
                                                                <input  type="date"  name="to_date" class="form-control" placeholder="">

                                                                <div class="invalid-feedback">{{$errors->first('date')}}</div>
                                                            </div>
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
                                            <button class="btn btn-label-brand btn-bold" type="submit">{{__('تصدير')}}</button>

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

@push('scripts')

@endpush
