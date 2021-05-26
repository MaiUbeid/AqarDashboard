@extends('admin_v2.layout.app')

@section('content')
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
                  url: '{{$index_url}}',
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
                element.find('#user-model').on('click', function (event) {
                  var element = $(this);
                  var id = element.attr('data-id');
                  var url = '{{route('admin.getUser',':id')}}';
                  url = url.replace(':id', id);


                  $.ajax({
                    url: url,
                    method: 'post',
                    type: 'post',
                    data: {
                      _token: '{{csrf_token()}}',

                    },
                  })
                    .done(function (data) {


                      if (data.status == true) {
                        $('#users .modal-body').html('');

                        var str = '';

                        // $.map(data.data, function (key,value) {

                        str += '<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">' +
                          '<div class="form-group">' +
                          '<label>اسم المكتب</label>' +
                          '<input readonly="" value="' + data.data.name + '" type="text" class="form-control" id="kt_datepicker_1" readonly="" >' +
                          '</div> </div>' +
                          '<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">' +
                          '<div class="form-group">' +
                          '<label>البريد الإلكتروني</label>' +
                          '<input readonly="" value="' + data.data.email + '" type="text" class="form-control" id="kt_datepicker_1" readonly="" >' +
                          '</div> </div>' +
                          '<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">' +
                          '<div class="form-group">' +
                          '<label>رقم الجوال</label>' +
                          '<input readonly="" value="' + data.data.mobile + '" type="text" class="form-control" id="kt_datepicker_1" readonly="" >' +
                          '</div>' +
                          ' </div>'+
                           '<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">' +
                           '<div class="form-group">' +
                          '<label class="kt-checkbox">\n' +
                          '<input checked type="checkbox"> البروفايل مكتمل\n' +
                          '<span></span>\n' +
                           '</label>'+
                            '</div>' +
                             ' </div>';





                        //   });


                        $('#users .modal-body').append(str);

                        $('#users').modal('toggle');

                      } else if (data.status === 'cant_delete') {
                        toastr.warning('@lang('cant_deleted')');
                      } else {
                        toastr.warning('@lang('not_deleted')');
                      }

                    })
                    .fail(function () {
                      toastr.error('@lang('something_wrong')');
                    });


                });
              },
            },

            // columns definition
            columns: [
              {
                field: 'uuid',
                title: '{{__('views.uuid')}}',
                sortable: false,
                width: 50,
                template: function (row, index, datatable) {
                  return '<button data-id="' + row.uuid + '" id="request-model" type="button" class="btn" onclick="alert()">\n' +
                    '                            <i class="far fa-share-alt mr-1"></i>\n' + row.uuid +
                    '                </button>';
                },

              },


              {
                field: 'user_name',
                title: '{{__('اسم المكتب')}}',
                sortable: false,
                width: 100,
                template: function (row, index, datatable) {
                  return '<a style="color: blue" data-id="' + row.user_id + '" id="user-model"  class="btn" >\n' +
                    '                            <i class="far fa-share-alt mr-1"></i>\n' + row.user.name +
                    '                </a>';
                },
              },

              {
                field: 'is_complete',
                title: '{{__('البرفايل مكتمل')}}',
                sortable: false,
                width: 100,
                template: function (row, index, datatable) {

                  var check='';
                  if(row.user.name !=null && row.user.email !=null)
                    check='checked';

                  return   '<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">' +
                          '<div class="form-group">' +
                          '<label class="kt-checkbox">\n' +
                          '<input readonly '+check+' type="checkbox">' +
                          '<span></span>\n' +
                          '</label>'+
                          '</div>' +
                          ' </div>';
                },
              },



              {
                field: 'user_mobile',
                title: '{{__('رقم الجوال')}}',
                sortable: false,
                width: 100,
                template: function (row, index, datatable) {
                  return '<span ><i class="far fa-share-alt mr-1"></i>\n' + row.user.mobile +
                    '                </span>';
                },
              },


              {
                field: 'payment_method_id',
                title: '{{__('views.payment_method_id')}}',
                sortable: false,
                width: 100,
                template: function (row, index, datatable) {

                  if (row.payment_method_id == null) {
                    return '<span>لم يتم تحديد طريقة الدفع</span>';
                  } else if (row.payment_method_id == '1') {
                    return '<span>باي فورت</span>';
                  } else if (row.payment_method_id == '2') {
                    return '<span>تحويل بنكي</span>';
                  }

                },
              },


              {
                field: 'status',
                sortable: false,
                width: 100,
                title: '{{__('views.payment_status')}}',
                template: function (row, index, datatable) {
                  if (row.status = '0') {
                    return '<span>لم يتم الدفع</span>';

                  } else {
                    return '<span>تم الدفع</span>';

                  }

                },
              },

              {
                field: 'created_at',
                sortable: false,
                title: '{{__('views.Date of Creation')}}',
                template: function (row, index, datatable) {
                  return moment(row.created_at).format("YYYY/MM/DD HH:mm");
                },
              },


              {
                field: "Actions",
                width: 80,
                title: "{{__('views.Actions')}}",
                sortable: false,
                autoHide: false,
                overflow: 'visible',
                template: function (row) {

                  var edit_url = '{{$edit_url}}'.replace('id', row.id);


                  return '\
              <div class="dropdown">\
                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
                  <i class="flaticon-more-1"></i>\
                </a>\
                <div class="dropdown-menu dropdown-menu-right">\
                  <ul class="kt-nav">\
                    <li class="kt-nav__item">\
                      <a href="' + edit_url + '" class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text">{{__('تفاصيل')}}</span>\
                      </a>\
                    </li>\
                  </ul>\
                </div>\
              </div>\
            ';
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
