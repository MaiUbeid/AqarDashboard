<?php

    $lang_route = 'admin.dashboard.lang';
    $dashboard_index = route('admin.dashboard.index');
    $logout_url = route('admin.logout');
    $edit_current_user_url = route('admin.settings.edit');

?>
<!DOCTYPE html>
@if(app()->getLocale() === "en")
<html lang="{{app()->getLocale()}}">
@else
<html lang="{{app()->getLocale()}}" direction="rtl" dir="rtl" style="direction: rtl">
@endif
    <!-- begin::Head -->
    <head>
        <base href="/">
        <meta charset="utf-8" />
        <title>جهات التمويل</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{csrf_token()}}">


        <!--begin::Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap&subset=arabic" rel="stylesheet">

        <!--end::Fonts -->

        <!--begin::Page Vendors Styles(used by this page) -->
        <link href="admin_assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />

        <!--end::Page Vendors Styles -->

        <!--begin::Global Theme Styles(used by all pages) -->
@if(app()->getLocale() === "en")
        <link href="admin_assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="admin_assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
@else
        <link href="admin_assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet" type="text/css" />
        <link href="admin_assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
        <style>
        html, body {
          font-family: 'Cairo', Poppins, Helvetica, sans-serif;
        }
        /* fix bug for kt-datatable__pager-size for rtl */
        .bootstrap-select.bs-container {
            left: 0;
            right: unset;
        }
        /* fix bug for kt-datatable__pager-size for rtl */
        select.form-control {
            padding-bottom: 4px;
        }
        </style>
@endif


        <!--end::Global Theme Styles -->

        <!--begin::Layout Skins(used by all pages) -->

        <!--end::Layout Skins -->
        <link rel="shortcut icon" href="{{asset('img/logo.png')}}" />

        @stack('css')
    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

        <!-- begin:: Page -->

        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__logo">
                <a href="{{$dashboard_index}}">
                  @if(app()->getLocale() === "en")
                  <img alt="Logo" src="{{asset('img/logo.png')}}" style="width: 100px;height: 60px">
                  @else
                  <img alt="Logo" src="{{asset('img/logo.png')}}" style="width: 100px;height: 60px">
                  @endif
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
            </div>
        </div>

        <!-- end:: Header Mobile -->
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

                <!-- begin:: Aside -->
                <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                    <!-- begin:: Aside -->
                    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                        <div class="kt-aside__brand-logo">
                            <a href="{{$dashboard_index}}">
                              @if(app()->getLocale() === "en")
                              <img class="image-fluid" alt="Logo" src="{{asset('img/logo.png')}}" style="width: 100px;height: 60px">
                              @else
                                    <img class="image-fluid" alt="Logo" src="{{asset('img/logo.png')}}" style="width: 100px;height: 61px">
                              @endif
                            </a>
                        </div>
                        <div class="kt-aside__brand-tools">
                            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler"><span></span></button>
                        </div>
                    </div>

                    <!-- end:: Aside -->

                    <!-- begin:: Aside Menu -->
                    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
                            <ul class="kt-menu__nav ">
                                <?php

                                    $menu_list = get_admin_menu_list();

                                ?>
                                @foreach($menu_list as $menu_item )
                                @if(count($menu_item['children']))

                                <li class="kt-menu__item kt-menu__item--submenu {{ $menu_item['is_active'] ? 'kt-menu__item--open kt-menu__item--here' : '' }}" aria-haspopup="true" >
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon {{$menu_item['icon']}}"></i>
                                        <span class="kt-menu__link-text">{{$menu_item['text']}}</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            @foreach($menu_item['children'] as $menu_child )
                                            <li class="kt-menu__item {{ $menu_child['is_active'] ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{$menu_child['url']}}" class="kt-menu__link "><i class="kt-menu__link-icon {{$menu_child['icon']}}"><span></span></i><span class="kt-menu__link-text"> {{$menu_child['text']}}</span></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>

                                @else
                                <li class="kt-menu__item {{ $menu_item['is_active'] ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{$menu_item['url']}}" class="kt-menu__link "><i class="kt-menu__link-icon {{$menu_item['icon']}}"></i>
                                        <span class="kt-menu__link-text">{{$menu_item['text']}}</span>
                                    </a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- end:: Aside Menu -->
                </div>

                <!-- end:: Aside -->
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                    <!-- begin:: Header -->
                    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

                        <!-- begin: Header Menu -->
                        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                                <ul class="kt-menu__nav "></ul>
                            </div>
                        </div>

                        <!-- end: Header Menu -->

                        <!-- begin:: Header Topbar -->
                        <div class="kt-header__topbar">
                            <!--begin: Language bar -->
                            <div class="kt-header__topbar-item kt-header__topbar-item--langs">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                    <span class="kt-header__topbar-icon">
                                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">
                                        @if(app()->getLocale() === "en")
                                          {{__('views.English_swicher')}}
                                        @else
                                          {{__('views.Arabic_swicher')}}
                                        @endif
                                    </span>
                                </div>

                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
                                    <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                                        <?php
                                        $lang_list = [
                                            'ar' => [
                                                'code' => 'ar',
                                                'text' => __('views.Arabic_swicher'),
                                            ],
                                            'en' => [
                                                'code' => 'en',
                                                'text' => __('views.English_swicher'),
                                            ],
                                        ];
                                        ?>
                                        @foreach($lang_list as $lang_item )
                                        <li class="kt-nav__item {{$lang_item['code'] === app()->getLocale() ? 'kt-nav__item--active' : ''}}">
                                            <a href="{{ route($lang_route, $lang_item['code']) }}" class="kt-nav__link">
                                                <span class="kt-nav__link-text">{{$lang_item['text']}}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <!--end: Language bar -->

                            <!--begin: User Bar -->
                            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                                    <div class="kt-header__topbar-user">
                                        <span class="kt-header__topbar-welcome kt-hidden-mobile">{{__('views.Hi,')}}</span>
                                        <span class="kt-header__topbar-username kt-hidden-mobile">{{auth()->user()->name}}</span>
                                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{mb_substr(auth()->user()->name, 0, 1)}}</span>
                                    </div>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                                    <!--begin: Head -->
                                    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x">
                                        <div class="kt-user-card__avatar">
                                            <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{mb_substr(auth()->user()->name, 0, 1)}}</span>
                                        </div>
                                        <div class="kt-user-card__name" style="color: #595d6e;">
                                            {{auth()->user()->email}}
                                        </div>
                                    </div>

                                    <!--end: Head -->

                                    <!--begin: Navigation -->
                                    <div class="kt-notification">

                                        <a href="{{$edit_current_user_url}}" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <i class="flaticon2-calendar-3 kt-font-success"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title kt-font-bold">
                                                    {{__('views.My Profile')}}
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    {{__('views.Account settings and more')}}
                                                </div>
                                            </div>
                                        </a>
                                        <div class="kt-notification__custom kt-space-between">
                                            &nbsp;
                                            <a data-confirm="{{__('views.Are you sure?')}}" data-csrf="{{csrf_token()}}" data-method="post" data-to="{{$logout_url}}" href="{{$logout_url}}" rel="nofollow">
                                                {{__('views.Sign Out')}}
                                            </a>
                                        </div>
                                    </div>

                                    <!--end: Navigation -->
                                </div>
                            </div>

                            <!--end: User Bar -->
                        </div>

                        <!-- end:: Header Topbar -->
                    </div>

                    <!-- end:: Header -->
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                  @if(isset($html_breadcrumbs))
                                    <h3 class="kt-subheader__title">{{$html_breadcrumbs['title']}}</h3>
                                    <?php
                                        $icon = collect($menu_list)->filter(function ($item) {
                                                return $item['is_active'];
                                            })->flatMap(function($items) {
                                                return $items;
                                            })->get('icon', 'flaticon2-shelter');
                                    ?>
                                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                                    @if(isset($html_breadcrumbs['subtitle']))
                                    <div class="kt-subheader__breadcrumbs">
                                        <a href="javascript:;" class="kt-subheader__breadcrumbs-home"><i class="{{$icon}}"></i></a>
                                        <a href="javascript:;" class="kt-subheader__breadcrumbs-link">
                                            {{$html_breadcrumbs['subtitle']}} </a>
                                    </div>
                                    @endif
                                    @if(isset($html_breadcrumbs['datatable']))
                                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                                    <div class="kt-subheader__group" id="kt_subheader_search">
                                        <span class="kt-subheader__desc" id="kt_subheader_total">{{__('views.:number Total', ['number' => '-'])}}</span>
                                        <form class="kt-margin-l-20" id="kt_subheader_search_form">
                                            <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                                                <input type="text" class="form-control" placeholder="{{__('views.Search...')}}" id="generalSearch">
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span>
                                                <i class="flaticon2-search-1"></i>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="kt-subheader__group kt-hidden" id="kt_subheader_group_actions">
                                        <div class="kt-subheader__desc"><span id="kt_subheader_group_selected_rows"></span> {{__('views.Selected')}} </div>
                                        <div class="btn-toolbar kt-margin-l-20">
                                        @if(isset($subheader_actions))
                                        @foreach($subheader_actions as $subheader_action)
                                            @if($subheader_action['type'] === 'button')
                                            <button class="btn btn-label-danger btn-bold btn-sm btn-icon-h arabs_subheader_action_button" data-action-url="{{$subheader_action['url']}}" data-action-method="{{$subheader_action['method']}}" data-action-confirm="{{$subheader_action['confirm']}}">
                                                {{$subheader_action['text']}}
                                            </button>
                                            @else
                                            <div class="dropdown arabs_subheader_action_dropdown">
                                                <button type="button" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    {{$subheader_action['text']}}
                                                </button>
                                                <div class="dropdown-menu">
                                                    <ul class="kt-nav">
                                                        @foreach($subheader_action['options'] as $subheader_action_option)
                                                        <li class="kt-nav__item">
                                                            <a href="javascript:;" class="kt-nav__link" data-action-value="{{$subheader_action_option['value']}}" data-action-url="{{$subheader_action_option['url']}}" data-action-method="{{$subheader_action_option['method']}}" data-action-confirm="{{$subheader_action_option['confirm']}}">
                                                                <span class="kt-nav__link-text"><span class="kt-badge {{$subheader_action_option['class']}} kt-badge--inline kt-badge--bold kt-badge--rounded">{{$subheader_action_option['text']}}</span></span>
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                        @endif
                                        </div>
                                    </div>
                                    @endif
                                    @else
                                    <h3 class="kt-subheader__title">{{__('views.Dashboard')}}</h3>
                                    <span class="kt-subheader__separator kt-hidden"></span>
                                    <div class="kt-subheader__breadcrumbs">
                                        <a href="javascript:;" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            {{__('views.Application')}}</a>
                                    </div>
                                    @endif
                                </div>
                                <div class="kt-subheader__toolbar">
                                    <div class="kt-subheader__wrapper">
                                        @if(isset($html_new_path))
                                        <a href="{{$html_new_path}}" class="btn btn-label-brand btn-bold"> {{__('views.New')}} </a>
                                        @else
                                        <a href="javascript:;" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="" data-placement="left">
                                            <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">{{__('views.Today')}}</span>&nbsp;
                                            <span class="kt-subheader__btn-daterange-date" id="kt_dashboard_daterangepicker_date">{{date('Y-m-d')}}</span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- end:: Subheader -->

                        @yield('content')
                    </div>

                    <!-- begin:: Footer -->
                    <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                        <div class="kt-container  kt-container--fluid ">
                            <div class="kt-footer__copyright">
                                2019&nbsp;&copy;&nbsp;<a href="" target="_blank" class="kt-link">{{__('views.Arabsstock')}}</a>
                            </div>
                            <div class="kt-footer__menu">
                            </div>
                        </div>
                    </div>

                    <!-- end:: Footer -->
                </div>
            </div>
        </div>

        <!-- end:: Page -->

        <!-- begin::Scrolltop -->
        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>

        <!-- end::Scrolltop -->


        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
var KTAppOptions = {
    colors: {
        state: {
            brand: "#2c77f4",
            light: "#ffffff",
            dark: "#282a3c",
            primary: "#5867dd",
            success: "#34bfa3",
            info: "#36a3f7",
            warning: "#ffb822",
            danger: "#fd3995"
        },
        base: {
            label: ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
            shape: ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
        }
    }
};
        </script>

        <!-- end::Global Config -->

        <!--begin::Global Theme Bundle(used by all pages) -->
        <script src="admin_assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
        <script src="admin_assets/js/scripts.bundle.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js" integrity="sha256-VeNaFBVDhoX3H+gJ37DpT/nTuZTdjYro9yBruHjVmoQ=" crossorigin="anonymous"></script>

        <!--end::Global Theme Bundle -->

        <!--begin::Page Vendors(used by this page) -->
        <script src="admin_assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
        <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
        <script src="admin_assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>
        <script src="admin_assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
        <script>
"use strict";

// TODO move to js file and build it in plugins.bundle.js
(function () {
    var PolyfillEvent = eventConstructor();

    function eventConstructor() {
        if (typeof window.CustomEvent === "function") return window.CustomEvent;
        // IE<=9 Support
        function CustomEvent(event, params) {
            params = params || { bubbles: false, cancelable: false, detail: undefined };
            var evt = document.createEvent("CustomEvent");
            evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
            return evt;
        }
        CustomEvent.prototype = window.Event.prototype;
        return CustomEvent;
    }

    function buildHiddenInput(name, value) {
        var input = document.createElement("input");
        input.type = "hidden";
        input.name = name;
        input.value = value;
        return input;
    }

    function handleClick(element) {
        var to = element.getAttribute("data-to"),
            method = buildHiddenInput("_method", element.getAttribute("data-method")),
            csrf = buildHiddenInput("_token", element.getAttribute("data-csrf")),
            form = document.createElement("form"),
            target = element.getAttribute("target");

        form.method = element.getAttribute("data-method") === "get" ? "get" : "post";
        form.action = to;
        form.style.display = "hidden";

        if (target) form.target = target;

        form.appendChild(csrf);
        form.appendChild(method);
        document.body.appendChild(form);
        form.submit();
    }

    function handleConfirm(message, callback, element) {
        swal.fire("", message, "warning").then(function (result) {
            if (result.value) {
                callback(element);
            }
        });
    }

    window.addEventListener(
        "click",
        function (e) {
            var element = e.target;

            while (element && element.getAttribute) {
                if (element.getAttribute("data-method")) {
                    console.log("1111111");
                    var message = element.getAttribute("data-confirm");
                    if (message) {
                        handleConfirm(message, handleClick, element);
                    } else {
                        handleClick(element);
                    }
                    e.preventDefault();
                    console.log("1231231");
                    return false;
                } else {
                    element = element.parentNode;
                }
            }
        },
        false
    );
})();

/**
 * sends a request to the specified url from a form. this will change the window location.
 * @param {string} path the path to send the post request to
 * @param {object} params the paramiters to add to the url
 * @param {string} [method=post] the method to use on the form
 */

function post(path, params, method) {
  method = method || 'post'

  // The rest of this code assumes you are not using a library.
  // It can be made less wordy if you use one.
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = path;

  const hiddenField = document.createElement('input');
  hiddenField.type = 'hidden';
  hiddenField.name = '_method';
  hiddenField.value = method;
  form.appendChild(hiddenField);

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.submit();
}




@if(app()->getLocale() === "ar")
$.fn.KTDatatable.defaults.translate = {
    records: {
        processing: "الرجاء الانتظار...",
        noRecords: "لا يوجد بيانات"
    },
    toolbar: {
        pagination: {
            items: {
                default: {
                    first: "الأول",
                    prev: "السابق",
                    next: "التالي",
                    last: "الأخير",
                    more: "المزيد",
                    input: "رقم الصفحة",
                    select: "اختر حجم الصفحة"
                },
                info: "عرض @{{start}} - @{{end}} من @{{total}} حقل"
            }
        }
    }
};
swal = swal.mixin({ confirmButtonText: "نعم", cancelButtonText: "إغلاق" });

$.fn.select2.defaults.set("placeholder", "اختر قيمة");
$.fn.select2.defaults.set("language", "ar");
$.fn.select2.defaults.set("dir", "rtl");
$.fn.select2.defaults.set("language", {
    errorLoading: function () {
        return "لا يمكن تحميل النتائج";
    },
    inputTooLong: function (options) {
        return "الرجاء حذف " + (options.input.length - options.maximum) + " عناصر";
    },
    inputTooShort: function (options) {
        return "الرجاء إضافة " + (options.minimum - options.input.length) + " عناصر";
    },
    loadingMore: function () {
        return "جاري تحميل نتائج إضافية...";
    },
    maximumSelected: function (options) {
        return "تستطيع إختيار " + options.maximum + " بنود فقط";
    },
    noResults: function () {
        return "لم يتم العثور على أي نتائج";
    },
    searching: function () {
        return "جاري البحث…";
    },
    removeAllItems: function () {
        return "قم بإزالة كل العناصر";
    }
});

// TODO should use gettext here and remove if conditions
// TODO check select2 when empty
@endif

var locales = {
  loading: '{{__('views.Loading...')}}',
};

var message = "{{Session::get('error')}}";
message && swal.fire("Alert!", message, "error");
message = "{{Session::get('success')}}";
message && swal.fire("", message, "success");
        </script>

        <!--end::Page Vendors -->

        <!--begin::Page Scripts(used by this page) -->
        @stack('scripts')
        <!--end::Page Scripts -->



    </body>

    <!-- end::Body -->
</html>
