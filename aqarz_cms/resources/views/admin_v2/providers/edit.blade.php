@extends('admin_v2.layout.app')

@section('content')
    <!-- begin:: Content -->

    <!-- end:: Content -->

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <!--Begin::Section-->
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-md-12 col-lg-12 col-xl-4">

                            <!--begin:: Widgets/Stats2-1 -->
                            <div class="kt-widget1">
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">العقارات</h3>
                                        <span class="kt-widget1__desc">عدد العروض الخاصة بالعقاري</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-brand">{{$count_estate}}</span>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">الطلبات</h3>
                                        <span class="kt-widget1__desc">عدد الطلبات المرسلة للعقاري</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-danger">{{$count_request}}</span>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">العروض</h3>
                                        <span class="kt-widget1__desc">عدد العروض المرسلة</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-success">{{$count_offer}}</span>
                                </div>
                            </div>

                            <!--end:: Widgets/Stats2-1 -->
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-4">

                            <!--begin:: Widgets/Stats2-2 -->
                            <div class="kt-widget1">
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">العملاء</h3>
                                        <span class="kt-widget1__desc">عدد العملاء</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-success">{{$count_client}}</span>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">الزيارات</h3>
                                        <span class="kt-widget1__desc">عدد الزيارت للعقاري</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-info">{{$user->count_visit}}</span>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">التقييم</h3>
                                        <span class="kt-widget1__desc">تقييم العقاري</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-warning">{{$user->rate}}</span>
                                </div>
                            </div>

                            <!--end:: Widgets/Stats2-2 -->
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-4">

                            <!--begin:: Widgets/Stats2-3 -->
                            <div class="kt-widget1">
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">الاتصالات</h3>
                                        <span class="kt-widget1__desc">عدد الاتصالات على العقاري</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-success">{{$user->count_call}}</span>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">العروض المقبولة</h3>
                                        <span class="kt-widget1__desc">العروض المقبولة في التطبيق</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-danger">{{$count_accept_offer}}</span>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">العروض المقبولة من الصندوق</h3>
                                        <span class="kt-widget1__desc">عدد العروض المبقولة من الصندوق</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-primary">{{$count_accept_fund_offer}}</span>
                                </div>
                            </div>

                            <!--end:: Widgets/Stats2-3 -->
                        </div>
                    </div>
                </div>
            </div>

            <!--End::Section-->

            <!--Begin::Section-->


            <!--End::Section-->

            <!--Begin::Section-->


            <!--End::Section-->

            <!--Begin::Section-->


            <!--End::Section-->

            <!--Begin::Section-->


            <!--End::Section-->

            <!--Begin::Section-->

            <div class="row">

                <div class="col-xl-6 col-lg-12">

                    <!--begin:: Widgets/Sale Reports-->
                    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    اجدد العقارات
                                </h3>
                            </div>

                        </div>
                        <div class="kt-portlet__body">

                            <!--Begin::Tab Content-->
                            <div class="tab-content">

                                <!--begin::tab 1 content-->
                                <div class="tab-pane active" id="kt_widget11_tab1_content">

                                    <!--begin::Widget 11-->
                                    <div class="kt-widget11">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>


                                                    <td style="width:1%">رقم العرض</td>
                                                    <td style="width:40%">نوع العقار</td>
                                                    <td style="width:14%">تاريخ النشر </td>
                                                    <td style="width:15%">المدينة</td>
                                                    <td style="width:15%">حالة العقار</td>
                                                    <td style="width:15%" class="kt-align-right">سعر العرض</td>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @if($new_estate)

                                                    @foreach($new_estate as $new_estateItem)
                                                        <tr>
                                                            <td>
                                                                {{$new_estateItem->id}}
                                                            </td>
                                                            <td>
                                                                {{$new_estateItem->estate_type_name}}
                                                            </td>
                                                            <td> {{$new_estateItem->created_at}}</td>
                                                            <td>{{$new_estateItem->city_name}}</td>
                                                            <td><span class="kt-badge kt-badge--inline @if($new_estateItem->status==null) kt-badge--warning @elseif($new_estateItem->status=='accepted_customer') kt-badge--success @elseif($new_estateItem->status=='1')kt-badge--success @else kt-badge--danger   @endif ">
                                                                    @if($new_estateItem->status==null)
                                                                        انتظار
                                                                    @elseif($new_estateItem->status=='accepted_customer')
                                                                        مكتمل
                                                                    @elseif($new_estateItem->status=='1')
                                                                        مفعل
                                                                    @else
                                                                        منتهي
                                                                    @endif
                                                                </span></td>
                                                            <td class="kt-align-right kt-font-brand kt-font-bold"> {{$new_estateItem->total_price}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <!--end::Widget 11-->
                                </div>

                                <!--end::tab 1 content-->

                                <!--begin::tab 2 content-->

                                </div>

                                <!--end::tab 3 content-->
                            </div>

                            <!--End::Tab Content-->
                        </div>
                    </div>

                    <!--end:: Widgets/Sale Reports-->
                </div>

            <div class="row">

                <div class="col-xl-6 col-lg-12">

                    <!--begin:: Widgets/Sale Reports-->
                    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    اجدد العروض
                                </h3>
                            </div>

                        </div>
                        <div class="kt-portlet__body">

                            <!--Begin::Tab Content-->
                            <div class="tab-content">

                                <!--begin::tab 1 content-->
                                <div class="tab-pane active" id="kt_widget11_tab1_content">

                                    <!--begin::Widget 11-->
                                    <div class="kt-widget11">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td style="width:1%">رقم العرض</td>
                                                    <td style="width:40%">نوع العرض</td>
                                                    <td style="width:14%">اسم المستفيد </td>
                                                    <td style="width:15%">رقم المستفيد</td>
                                                    <td style="width:15%">حالة العرض</td>
                                                    <td style="width:15%" class="kt-align-right">سعر العرض</td>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @if($new_offer)
                                                    @foreach($new_offer as $new_offerItem)
                                                <tr>
                                                    <td>
                                                        {{$new_offerItem->id}}
                                                    </td>
                                                    <td>
                                                       {{$new_offerItem->estate->estate_type_name}}
                                                    </td>
                                                    <td> {{$new_offerItem->user->name}}</td>
                                                    <td>{{$new_offerItem->user->mobile}}</td>
                                                    <td><span class="kt-badge kt-badge--inline @if($new_offerItem->status==null) kt-badge--warning @elseif($new_offerItem->status=='accepted_customer') kt-badge--success @elseif($new_offerItem->status=='active')kt-badge--brand @else kt-badge--danger   @endif ">
                                                            @if($new_offerItem->status==null)
                                                               انتظار
                                                            @elseif($new_offerItem->status=='accepted_customer')
                                                               مكتمل
                                                            @elseif($new_offerItem->status=='active')
                                                                تم الموافقة
                                                            @else
                                                              منتهي
                                                            @endif
                                                        </span></td>
                                                    <td class="kt-align-right kt-font-brand kt-font-bold"> {{$new_offerItem->estate->total_price}}</td>
                                                </tr>
                                                @endforeach
                                                    @endif

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <!--end::Widget 11-->
                                </div>

                                <!--end::tab 1 content-->

                                <!--begin::tab 2 content-->
                                <div class="tab-pane" id="kt_widget11_tab2_content">

                                    <!--begin::Widget 11-->
                                    <div class="kt-widget11">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td style="width:1%">#</td>
                                                    <td style="width:40%">Application</td>
                                                    <td style="width:14%">Sales</td>
                                                    <td style="width:15%">Change</td>
                                                    <td style="width:15%">Status</td>
                                                    <td style="width:15%" class="kt-align-right">Total</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="kt-checkbox kt-checkbox--single">
                                                            <input type="checkbox"><span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="kt-widget11__title">Loop</span>
                                                        <span class="kt-widget11__sub">CRM System</span>
                                                    </td>
                                                    <td>19,200</td>
                                                    <td>$63</td>
                                                    <td><span class="kt-badge kt-badge--inline kt-badge--danger">pending</span></td>
                                                    <td class="kt-align-right kt-font-brand  kt-font-bold">$23,740</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                    </td>
                                                    <td>
                                                        <span class="kt-widget11__title">Selto</span>
                                                        <span class="kt-widget11__sub">Powerful Website Builder</span>
                                                    </td>
                                                    <td>24,310</td>
                                                    <td>$39</td>
                                                    <td><span class="kt-badge kt-badge--inline kt-badge--success">new</span></td>
                                                    <td class="kt-align-right kt-font-success  kt-font-bold">$46,010</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                    </td>
                                                    <td>
                                                        <span class="kt-widget11__title">Jippo</span>
                                                        <span class="kt-widget11__sub">The Best Selling App</span>
                                                    </td>
                                                    <td>9,076</td>
                                                    <td>$105</td>
                                                    <td><span class="kt-badge kt-badge--inline kt-badge--brand">approved</span></td>
                                                    <td class="kt-align-right kt-font-danger kt-font-bold">$15,800</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                    </td>
                                                    <td>
                                                        <span class="kt-widget11__title">Verto</span>
                                                        <span class="kt-widget11__sub">Web Development Tool</span>
                                                    </td>
                                                    <td>11,094</td>
                                                    <td>$16</td>
                                                    <td><span class="kt-badge kt-badge--inline kt-badge--info">done</span></td>
                                                    <td class="kt-align-right kt-font-warning kt-font-bold">$8,520</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="kt-widget11__action kt-align-right">
                                            <button type="button" class="btn btn-label-success btn-bold btn-sm">Generate Report</button>
                                        </div>
                                    </div>

                                    <!--end::Widget 11-->
                                </div>

                                <!--end::tab 2 content-->

                                <!--begin::tab 3 content-->
                                <div class="tab-pane" id="kt_widget11_tab3_content">
                                </div>

                                <!--end::tab 3 content-->
                            </div>

                            <!--End::Tab Content-->
                        </div>
                    </div>

                    <!--end:: Widgets/Sale Reports-->
                </div>
            </div>

            <div class="row">

                <div class="col-xl-6 col-lg-12">

                    <!--begin:: Widgets/Sale Reports-->
                    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                  أجدد العروض للصندوق
                                </h3>
                            </div>

                        </div>
                        <div class="kt-portlet__body">

                            <!--Begin::Tab Content-->
                            <div class="tab-content">

                                <!--begin::tab 1 content-->
                                <div class="tab-pane active" id="kt_widget11_tab1_content">

                                    <!--begin::Widget 11-->
                                    <div class="kt-widget11">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td style="width:1%"></td>
                                                    <td style="width:30%">رقم العرض</td>
                                                    <td style="width:23%">نوع العرض</td>
                                                    <td style="width:23%">حالة العرض</td>
                                                    <td style="width:23%" class="kt-align-right">سعر العرض</td>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @if($new_fund_offer)
                                                    @foreach($new_fund_offer as $new_fund_offerItem)
                                                        <tr>
                                                            <td>
                                                                {{$new_fund_offerItem->id}}
                                                            </td>
                                                            <td>
                                                                {{$new_fund_offerItem->uuid}}
                                                            </td>
                                                            <td>
                                                                {{$new_fund_offerItem->estate->estate_type_name}}
                                                            </td>

                                                            <td><span class="kt-badge kt-badge--inline @if($new_fund_offerItem->status==null) kt-badge--warning @elseif($new_fund_offerItem->status=='accepted_customer') kt-badge--success @elseif($new_fund_offerItem->status=='active')kt-badge--brand @else kt-badge--danger   @endif ">
                                                                    @if($new_fund_offerItem->status==null)
                                                                        انتظار
                                                                    @elseif($new_fund_offerItem->status=='accepted_customer')
                                                                        مكتمل
                                                                    @elseif($new_fund_offerItem->status=='active')
                                                                        تم الموافقة
                                                                    @else
                                                                        منتهي
                                                                    @endif
                                                                </span></td>
                                                            <td class="kt-align-right kt-font-brand kt-font-bold"> {{$new_fund_offerItem->estate->total_price}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <!--end::Widget 11-->
                                </div>

                                <!--end::tab 1 content-->

                                <!--begin::tab 2 content-->
                                <div class="tab-pane" id="kt_widget11_tab2_content">

                                    <!--begin::Widget 11-->
                                    <div class="kt-widget11">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td style="width:1%">#</td>
                                                    <td style="width:40%">Application</td>
                                                    <td style="width:14%">Sales</td>
                                                    <td style="width:15%">Change</td>
                                                    <td style="width:15%">Status</td>
                                                    <td style="width:15%" class="kt-align-right">Total</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="kt-checkbox kt-checkbox--single">
                                                            <input type="checkbox"><span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="kt-widget11__title">Loop</span>
                                                        <span class="kt-widget11__sub">CRM System</span>
                                                    </td>
                                                    <td>19,200</td>
                                                    <td>$63</td>
                                                    <td><span class="kt-badge kt-badge--inline kt-badge--danger">pending</span></td>
                                                    <td class="kt-align-right kt-font-brand  kt-font-bold">$23,740</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                    </td>
                                                    <td>
                                                        <span class="kt-widget11__title">Selto</span>
                                                        <span class="kt-widget11__sub">Powerful Website Builder</span>
                                                    </td>
                                                    <td>24,310</td>
                                                    <td>$39</td>
                                                    <td><span class="kt-badge kt-badge--inline kt-badge--success">new</span></td>
                                                    <td class="kt-align-right kt-font-success  kt-font-bold">$46,010</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                    </td>
                                                    <td>
                                                        <span class="kt-widget11__title">Jippo</span>
                                                        <span class="kt-widget11__sub">The Best Selling App</span>
                                                    </td>
                                                    <td>9,076</td>
                                                    <td>$105</td>
                                                    <td><span class="kt-badge kt-badge--inline kt-badge--brand">approved</span></td>
                                                    <td class="kt-align-right kt-font-danger kt-font-bold">$15,800</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                    </td>
                                                    <td>
                                                        <span class="kt-widget11__title">Verto</span>
                                                        <span class="kt-widget11__sub">Web Development Tool</span>
                                                    </td>
                                                    <td>11,094</td>
                                                    <td>$16</td>
                                                    <td><span class="kt-badge kt-badge--inline kt-badge--info">done</span></td>
                                                    <td class="kt-align-right kt-font-warning kt-font-bold">$8,520</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="kt-widget11__action kt-align-right">
                                            <button type="button" class="btn btn-label-success btn-bold btn-sm">Generate Report</button>
                                        </div>
                                    </div>

                                    <!--end::Widget 11-->
                                </div>

                                <!--end::tab 2 content-->

                                <!--begin::tab 3 content-->
                                <div class="tab-pane" id="kt_widget11_tab3_content">
                                </div>

                                <!--end::tab 3 content-->
                            </div>

                            <!--End::Tab Content-->
                        </div>
                    </div>

                    <!--end:: Widgets/Sale Reports-->
                </div>
            </div>

        </div>
    </div>


                            <!--end: Datatable -->

            <!--End::Section-->

            <!--Begin::Section-->



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
