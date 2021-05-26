@extends('admin_v2.layout.app')

@section('content')

    <!-- begin:: Content -->
    <div style="display: none" class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Dashboard 1-->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <div class="row">
                <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                    <!--begin:: Widgets/Activity-->
                    <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                        <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    إحصائيات الطلبات والعروض
                                </h3>
                            </div>

                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-widget17">
                                <div
                                        class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides"
                                        style="background-color: #fd397a">
                                    <div class="kt-widget17__chart" style="height:320px;">
                                        <canvas id="kt_chart_activities"></canvas>
                                    </div>
                                </div>
                                <div class="kt-widget17__stats">
                                    <div class="kt-widget17__items">
                                        <div class="kt-widget17__item">
                                            <span class="kt-widget17__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon kt-svg-icon--brand">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path
                                                                d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                                fill="#000000"/>
                                                        <rect fill="#000000" opacity="0.3"
                                                              transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) "
                                                              x="16.3255682" y="2.94551858" width="3" height="18" rx="1"/>
                                                    </g>
                                                </svg>
                                            </span>
                                            <span class="kt-widget17__subtitle">
                                                <a href="{{route('admin.payment_requests.index')}}">

                                                    <span class="kt-widget17__subtitle">
                                                        {{__('views.requests')}}
                                                    </span>
                                                </a>

                                                <span class="kt-widget17__desc">
                                                    {{$requests}}

                                                </span>


                                            </span>
                                        </div>

                                        <div class="kt-widget17__item">
                                            <span class="kt-widget17__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon kt-svg-icon--success">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                        <path
                                                                d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                                fill="#000000" fill-rule="nonzero"/>
                                                        <path
                                                                d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                                fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </span>

                                            <a href="{{url('/fund/offer/requests')}}">
                                                <span class="kt-widget17__subtitle">
                                                    {{__('views.offers')}}
                                                </span>
                                            </a>
                                            <span class="kt-widget17__desc">
                                                {{$all_offer}}
                                            </span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Activity-->
                </div>

                <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                    <!--begin:: Widgets/Inbound Bandwidth-->
                    <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder kt-portlet--height-fluid-half">
                        <div class="kt-portlet__head kt-portlet__space-x">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    {{__('views.requests_has_offers')}}
                                </h3>
                            </div>

                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget20">
                                <div class="kt-widget20__content kt-portlet__space-x">
                                    <a href="{{url('fund/requests?offer_status=have_offers')}}">
                                        <span class="kt-widget20__number kt-font-brand">{{$requests_has_offer}}+</span>
                                    </a>
                                    <span class="kt-widget20__desc">              {{__('views.requests_has_offers')}} </span>

                                </div>
                                <div class="kt-widget20__chart" style="height:130px;">
                                    <canvas id="kt_chart_bandwidth1"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Inbound Bandwidth-->
                    <div class="kt-space-20"></div>

                    <!--begin:: Widgets/Outbound Bandwidth-->
                    <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder kt-portlet--height-fluid-half">
                        <div class="kt-portlet__head kt-portlet__space-x">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    {{__('views.requests_accept_fund')}}
                                </h3>
                            </div>

                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget20">
                                <div class="kt-widget20__content kt-portlet__space-x">
                                    <a href="{{url('fund/requests?offer_status=have_active_offers')}}">
                                        <span class="kt-widget20__number kt-font-danger">{{$accept_requests_from_fund}}+</span>
                                    </a>
                                    <span class="kt-widget20__desc">   {{__('views.requests_accept_fund')}} </span>
                                </div>
                                <div class="kt-widget20__chart" style="height:130px;">
                                    <canvas id="kt_chart_bandwidth2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--end:: Widgets/Outbound Bandwidth-->
                </div>


            </div>

            <div class="row">
                <div class="col-xl-8 col-lg-12 order-lg-3 order-xl-1">
                    <!--begin:: Widgets/Best Sellers-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">

                            <form class="form-horizontal row" method="get" action="{{url('/dashboard')}}">

                                <div class="kt-portlet__body col-md-4">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12">التاريخ من</label>
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                            <input @if(isset($_GET['from_date'])) value="{{$_GET['from_date']}}" @endif name="from_date" type="text" class="form-control" id="kt_datepicker_1" readonly placeholder="اختر تاريخ"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body col-md-4">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12">التاريخ الي</label>
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                            <input @if(isset($_GET['to_date'])) value="{{$_GET['to_date']}}" @endif name="to_date" type="text" class="form-control" id="kt_datepicker_1" readonly placeholder="اختر تاريخ"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body col-md-4">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-3">{{__('views.requests')}}</label>
                                        <div class="col-sm-9">
                                            <select class="form-control kt-select2" id="kt_select2_1" name="request_fund">

                                                <option value="">{{__('views.choose_request')}} </option>


                                                @if($requests_content)
                                                    @foreach($requests_content as $requests_contentItem)
                                                        <option @if(isset($_GET['request_fund']) && $_GET['request_fund'] != null && $_GET['request_fund']==$requests_contentItem->uuid) selected @endif value="{{$requests_contentItem->uuid}}">{{$requests_contentItem->uuid}} </option>
                                                    @endforeach
                                                @endif


                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-9 col-xl-9" style="margin-bottom: 10px;">
                                    <div class="dropdown dropdown-inline">
                                        <button type="submit" class="btn btn-success btn-icon-sm">
                                            فلترة
                                            <i class="flaticon2-search" style="font-size: 1rem;"></i>
                                        </button>

                                    </div>
                                    <div class="dropdown dropdown-inline">
                                        <a href="{{url('dashboard')}}" class="btn btn-secondary btn-icon-sm">
                                            العودة
                                            <i class="la la-long-arrow-left" style="font-size: 1rem;"></i>
                                        </a>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                                    <div class="kt-widget5">


                                        @if($offers)
                                            @foreach($offers as $offersItem)
                                                <div class="kt-widget5__item">
                                                    <div class="kt-widget5__content">
                                                        <div class="kt-widget5__section">
                                                            <a href="#" class="kt-widget5__title">
                                                                {{$offersItem->uuid}}
                                                            </a>


                                                        </div>
                                                    </div>
                                                    <div class="kt-widget5__content">
                                                        <div class="kt-widget5__stats">
                                                            <span class="kt-widget5__number">{{__('views.Date of Creation')}}</span>
                                                            <span class="kt-widget5__sales">{{$offersItem->created_at}}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @else

                                            {{__('views.dont_have_offer')}}
                                        @endif
                                    </div>


                                    <div class="container-paginator">

                                        {{ $offers->appends(['request_fund' => isset($_GET['request_fund'])?$_GET['request_fund']:null, 'from_date' => isset($_GET['from_date'])?$_GET['from_date']:null,'to_date' => isset($_GET['to_date'])?$_GET['to_date']:null])->links() }}

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Best Sellers-->
                </div>


                <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">
                    <!--begin:: Widgets/Profit Share-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-widget14">
                            <div class="kt-widget14__header">
                                <h3 class="kt-widget14__title">
                                    {{__('views.most_offers')}}
                                </h3>
                                <span class="kt-widget14__desc">
                                    {{__('views.most_offers')}}
                                </span>
                            </div>
                            <div class="kt-widget14__content">
                                <div class="kt-widget14__chart">
                                    <div class="kt-widget14__stat">{{count($active_offer)}}</div>
                                    <canvas id="kt_chart_profit_share" style="height: 140px; width: 140px;"></canvas>
                                </div>
                                <div class="kt-widget14__legends">

                                    @if($active_offer)
                                        @foreach($active_offer as $active_offerItem)

                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-fill-info"></span>
                                                <a href="{{url('/fund/offer/requests?uuid='.$active_offerItem->uuid)}}">
                                                    <span class="kt-widget14__stats">+{{$active_offerItem->count_offers}} {{$active_offerItem->uuid}}</span>

                                                </a>
                                            </div>

                                        @endforeach
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Profit Share-->
                </div>

                <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">
                    <!--begin:: Widgets/Revenue Change-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-widget14">
                            <div class="kt-widget14__header">
                                <h3 class="kt-widget14__title">
                                    {{__('views.dont_have_offer')}}
                                </h3>
                                <span class="kt-widget14__desc">
                                    {{__('views.dont_have_offer')}}
                                </span>
                            </div>
                            <div class="kt-widget14__content">
                                <div class="kt-widget14__chart">

                                    <div id="kt_chart_revenue_change" style="height: 150px; width: 150px;"></div>
                                    <div class="kt-widget14__stat">{{count($requests_dont_offer)}}</div>
                                </div>
                                <div class="kt-widget14__legends">

                                    @if($requests_dont_offer)
                                        @foreach($requests_dont_offer as $requests_dont_offerItem)

                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-fill-info"></span>
                                                <a href="{{url('/fund/offer/requests?uuid='.$requests_dont_offerItem->uuid)}}">
                                                    <span class="kt-widget14__stats">+{{$requests_dont_offerItem->count_offers}} {{$requests_dont_offerItem->uuid}}</span>

                                                </a>
                                            </div>

                                        @endforeach
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Revenue Change-->
                </div>
            </div>
        </div><!-- /.content-wrapper -->


        <!--End::Dashboard 1-->
    </div>
    <!-- end:: Content -->

@endsection

@push('css')

@endpush


@push('scripts')

    <!-- Morris -->



    <script>


    </script>
@endpush
