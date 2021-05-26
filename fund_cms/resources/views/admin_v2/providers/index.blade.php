@extends('admin_v2.layout.app')

@section('content')
    <?php
    $time = null;
    $user_status = null;
    if (isset($_GET['time'])) {
        $time = $_GET['time'];
    } else {
        $time = null;
    }
    if (isset($_GET['user_status'])) {
        $user_status = $_GET['user_status'];
    } else {
        $user_status = null;
    }


    ?>
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">

            <div class="kt-portlet__body kt-portlet__body--fit">

                <div class="col-md-12">
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8  order-xl-1">

                                <div class="row align-items-center">

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <label>{{__('views.form_date')}}</label>
                                            <input type="text" class="form-control" id="kt_datepicker_1" readonly="" placeholder="اختر تاريخ ">
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <label>{{__('views.to_date')}}</label>
                                            <input type="text" class="form-control" id="kt_datepicker_2" readonly="" placeholder="اختر تاريخ ">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <!--begin: Datatable -->
                <div class="kt-datatable" id="kt_category_list_datatable"></div>
                <!--end: Datatable -->
            </div>
        </div>
        <!--end::Portlet-->
    </div>
    <div class="modal fade" id="users" tabindex="-1" role="dialog" aria-labelledby="users" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sharemodel">{{__('ملف المستخدم')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

@push('css')
@endpush


@push('scripts')
    <script>
      var str = '';
      @if($time)

        str = '?user_status=' + '{{$user_status}}' + '&time=' + '{{$time}}';

      @elseif($user_status)
        str = '?user_status=' + '{{$user_status}}';
        @else
          str='';
      @endif

        "use strict";
      var KTUserListDatatable = function () {

        // variables
        var datatable;

        // init
        var init = function () {
          // init the datatables. Learn more: https://keenthemes.com/metronic/?page=docs&section=datatable
          datatable = $('#kt_category_list_datatable').KTDatatable({
            // datasource definition
            data: {
              type: 'remote',
              source: {
                read: {
                  url: '{{$index_url}}' + str,
                  params: {
                    _token: '{{csrf_token()}}',
                  },
                },
              },
              pageSize: 10, // display 20 records per page
              serverPaging: true,
              serverFiltering: true,
              serverSorting: true,
              saveState: {
                cookie: false,
              },
            },
            dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print',
            ],
            // layout definition
            layout: {
              scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
              footer: false, // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
              input: $('#generalSearch'),
              delay: 400,
            },

            rows: {
              afterTemplate: function (element, data, rowNumber) {

              },
            },

            // columns definition
            columns: [
              {
                field: 'id',
                title: '{{__('#')}}',
                sortable: false,
                width: 50,
                template: function (row, index, datatable) {
                  return '<button data-id="' + row.id + '" id="request-model" type="button" class="btn" onclick="alert()">\n' +
                    '                            <i class="far fa-share-alt mr-1"></i>\n' + row.id +
                    '                </button>';
                },

              },

              {
                field: 'name',
                sortable: false,
                width: 100,
                title: '{{__('اسم المكتب')}}',
              },
              {
                field: 'onwer_name',
                sortable: false,
                width: 100,
                title: '{{__('اسم المالك')}}',
              },


              {
                field: 'is_pay',
                title: '{{__('حساب مرقى')}}',
                sortable: false,
                width: 50,
                template: function (row, index, datatable) {
                  if (row.is_pay == '1') {
                    return '<span class="class="btn btn-primary"">نعم</span>';
                  } else {
                    return '<span class="class="btn btn-danger"">نعم</span>';
                  }
                },
              },


              {
                field: 'is_certified',
                title: '{{__('مكتب موثق')}}',
                sortable: false,
                width: 50,
                template: function (row, index, datatable) {

                  var check = '';
                  if (row.is_certified != null && row.is_certified != '0') {
                    return 'نعم';
                  }
                  return 'لا';


                },
              },

              {
                field: 'mobile',
                title: '{{__('رقم الجوال')}}',
                sortable: false,
                width: 100,
                template: function (row, index, datatable) {
                  return '<span ><i class="far fa-share-alt mr-1"></i>\n' + row.mobile +
                    '                </span>';
                },
              },


            ],
          });
        };

        // search
        /* var search = function () {
           $('#kt_form_status').on('change', function () {
             datatable.search($(this).val().toLowerCase(), 'Status');
           });
         };*/


        var filter = function () {

          $('#kt_datepicker_1').on('change', function () {
            datatable.search($(this).val(), 'form_date');
          });
          $('#kt_datepicker_2').on('change', function () {
            datatable.search($(this).val(), 'to_date');
          });
        };
        // selection
        var selection = function () {
          // init form controls
          //$('#kt_form_status, #kt_form_type').selectpicker();

          // event handler on check and uncheck on records
          datatable.on('kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated', function (e) {
            var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes(); // get selected records
            var count = checkedNodes.length; // selected records count

            $('#kt_subheader_group_selected_rows').html(count);

            if (count > 0) {
              $('#kt_subheader_search').addClass('kt-hidden');
              $('#kt_subheader_group_actions').removeClass('kt-hidden');
            } else {
              $('#kt_subheader_search').removeClass('kt-hidden');
              $('#kt_subheader_group_actions').addClass('kt-hidden');
            }
          });
        };

        // selected records delete


        var updateTotal = function () {
          datatable.on('kt-datatable--on-layout-updated', function () {
            $('#kt_subheader_total').html('{{__('views.:number Total', ['number' => 0])}}'.replace("0", datatable.getTotalRows()));
          });
        };

        return {
          // public functions
          init: function () {
            init();
            selection();
            filter();

            updateTotal();
          },
        };
      }();

      // On document ready
      KTUtil.ready(function () {
        KTUserListDatatable.init();
      });


      function translation(key) {

        if (key == 'id') {
          return 'الرقم';
        }
        if (key == 'uuid') {
          return 'رقم الطلب';
        }
        if (key == 'estate_type_id') {
          return 'رقم نوع العقار';
        }
        if (key == 'estate_status') {
          return 'حالة العقار';
        }
        if (key == 'area_estate_id') {
          return 'رقم المساحة';
        }
        if (key == 'dir_estate_id') {
          return 'رقم الاتجاه';
        }
        if (key == 'estate_price_id') {
          return 'رقم السعر';
        }
        if (key == 'street_view_id') {
          return 'رقم مساحة الشارع';
        }
        if (key == 'city_id') {
          return 'رقم المدينة';
        }
        if (key == 'neighborhood_id') {
          return 'رقم الحي';
        }
        if (key == 'rooms_number_id') {
          return 'رقم عدد الغرف';
        }
        if (key == 'created_at') {
          return 'تاريخ الانشاء';
        }
        if (key == 'estate_type_icon') {
          return 'صورة نوع العقار';
        }
        if (key == 'estate_type_name') {
          return 'نوع العقار';
        }
        if (key == 'dir_estate') {
          return 'اتجاه العقار';
        }
        if (key == 'street_view_range') {
          return 'مدى مساحة الشارع';
        }
        if (key == 'estate_price_range') {
          return 'مدى السعر';
        }
        if (key == 'area_estate_range') {
          return 'مدى المساحة';
        }
        if (key == 'city_name') {
          return 'اسم المدينة';
        }
        if (key == 'neighborhood_name') {
          return 'اسم الحي';
        }


      }
    </script>
@endpush
