@extends('admin_v2.layout.app')

@section('content')

    <?php
    $uuid=null;
    $status=null;
    if (isset($_GET['uuid'])) {
        $uuid = $_GET['uuid'];
    } else {
        $uuid = null;
    }


    if (isset($_GET['status'])) {
        $status = $_GET['status'];
    } else {
        $status = null;
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

                                    <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">


                                        <div class="form-group">
                                            <label>{{__('views.estate_type')}}</label>
                                            <div class="" style=" text-align: right;">
                                                <select class="form-control" id="estate_type_id" style="display: inline-block;width: 82%;">
                                                    <option value="">{{__('views.choose')}}</option>
                                                    @if($estate_type)
                                                        @foreach($estate_type as $estate_typeItem)
                                                            <option value="{{$estate_typeItem->id}}">{{$estate_typeItem->name}}</option>

                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">


                                        <div class="form-group">
                                            <label>{{__('views.city')}}</label>
                                            <div class="" style=" text-align: right;">
                                                <select class="form-control" id="city_id" style="display: inline-block;width: 82%;">
                                                    <option value="">{{__('views.choose')}}</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <label>{{__('views.form_date')}}</label>
                                            <input type="text" class="form-control" id="kt_datepicker_1" readonly="" placeholder="اختر تاريخ ">
                                        </div>
                                    </div>
                                    <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
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
    <div class="modal fade" id="reuqest" tabindex="-1" role="dialog" aria-labelledby="reuqest" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sharemodel">{{__('views.request')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="user" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sharemodel">{{__('معلومات المستخدم')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="status_model" tabindex="-1" role="dialog" aria-labelledby="status_model" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sharemodel">{{__('التحكم بحالة الطلب')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{route('admin.updateStatus')}}" >
                        <input type="hidden" name="id" id="fiance_id">
                        @csrf
                        @method('post')
                    <div class="form-group">
                        <label>{{__('حالة الطلب')}}</label>
                        <div class="" style=" text-align: right;">
                            <select name="status_id" class="form-control" id="status_id" style="display: inline-block;width: 82%;">
                                <option value="">{{__('views.choose')}}</option>
                                <option value="1">تم قبول الطلب</option>
                                <option value="0">تم رفض الطلب</option>


                            </select>
                        </div>
                    </div>
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-xl-3"></div>
                            <div class="col-lg-9 col-xl-6">
                                <button class="btn btn-label-brand btn-bold" type="submit">{{__('views.Save Changes')}}</button>
                                <a class="btn btn-clean btn-bold" href="{{$index_url}}">{{__('views.Cancel')}}</a>
                            </div>
                        </div>
                    </div>

                    </form>
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


      $("#city_id").select2({

        width: "100%",
        language: "ar",
        minimumInputLength: 1,
        dir: "rtl",
        ajax: {
          url: "{{$select2_city}}",
          dataType: 'json',
          data: function (params) {
            return {
              q: params.term, // search term
              page: params.page,
            };
          },

          processResults: function (data, params) {
            console.log(data);
            params.page = params.page || 1;

            return {
              results: $.map(data.data, function (item) {

                return {
                  text: item.name_ar,
                  id: item.serial_city,
                };
              }),
              pagination: {
                more: (params.page * 30) < data.total,
              },
            };
          },
          cache: true,
        },
        escapeMarkup: function (markup) {
          return markup;
        }, // let our custom formatter work
      });


      var str = '';
      @if($uuid)

        str = '?uuid=' + '{{$uuid}}' + '&status=' + '{{$status}}';

      @elseif($status)
        str = '?status=' + '{{$status}}';
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
                  url: '{{$index_url}}'+str,
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
                element.find('#request-model').on('click', function (event) {
                  var element = $(this);
                  var id = element.attr('data-id');
                  var url = '{{route('admin.getRequest',':id')}}';
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
                        $('#reuqest .modal-body').html('');

                        var str = '';

                        $.map(data.data, function (key, value) {

                          if(translation(value)!=false)
                          {
                            str += '<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">' +
                              '<div class="form-group">' +
                              '<label>' + translation(value) + '</label>' +
                              '<input readonly="" value="' + key + '" type="text" class="form-control" id="kt_datepicker_1" readonly="" >' +
                              '</div> </div>';
                          }



                        });


                        $('#reuqest .modal-body').append(str);

                        $('#reuqest').modal('toggle');

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
                        $('#reuqest .modal-body').html('');

                        var str = '';

                        $.map(data.data, function (key, value) {

                          if(translation(value)!=false)
                          {
                            str += '<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">' +
                              '<div class="form-group">' +
                              '<label>' + translation(value) + '</label>' +
                              '<input readonly="" value="' + key + '" type="text" class="form-control" id="kt_datepicker_1" readonly="" >' +
                              '</div> </div>';
                          }



                        });


                        $('#user .modal-body').append(str);

                        $('#user').modal('toggle');

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

                element.find('#status-model-button').on('click', function (event) {
                  var element = $(this);
                  var id = element.attr('data-id');
                  $('#status_model #fiance_id').val(id);
                  $('#status_model').modal('toggle');



                });
              },
            },

            // columns definition
            columns: [
              {
                field: 'id',
                title: '{{__('رقم الطلب')}}',
                sortable: false,
                width: 50,
                template: function (row, index, datatable) {
                  return '<button style="color: blue" data-id="' + row.id + '" id="request-model" type="button" class="btn" onclick="alert()">\n' +
                    '                            <i class="far fa-share-alt mr-1"></i>\n' + row.id +
                    '                </button>';
                },

              },
              {
                field: 'user_id',
                title: '{{__('اسم المستخدم')}}',
                sortable: false,
                width: 80,
                template: function (row, index, datatable) {
                  return '<button style="color: blue" data-id="' + row.user_id + '" id="user-model" type="button" class="btn" onclick="alert()">\n' +
                    '                            <i class="far fa-share-alt mr-1"></i>\n' + row.user_id +
                    '                </button>';
                },

              },

              {
                field: 'estate_type_name',
                width: 50,
                title: '{{__('views.estate_type')}}',
                sortable: false,
              },

              {
                field: 'building_number',
                width: 50,
                title: '{{__('رقم المبنى')}}',
                sortable: false,
              },


              {
                field: 'city_name',
                width: 50,
                title: '{{__('views.city')}}',
                sortable: false,
              },


              {
                field: 'created_at',
                width: 100,
                sortable: false,
                title: '{{__('views.Date of Creation')}}',
                template: function (row, index, datatable) {
                  return moment(row.created_at).format("YYYY/MM/DD HH:mm");
                },
              },

              {
                field: 'status',

                title: '{{__('حالة الطلب')}}',
                sortable: false,
                width: 100,
                template: function (row, index, datatable) {
                  var str = '';
                  var class_name = '';


                  if (row.status == '1') {
                    str = 'تم قبول الطلب';
                    class_name='badge badge-primary';
                  } else if (row.status == '0') {
                    str = 'تم رفض الطلب';
                    class_name='badge badge-danger';
                  }
                  return '<span data-id="' + row.id + '" id="status-model-button" class="'+class_name+'">' + str + '</span>';
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


          $('#estate_type_id').on('change', function () {
            datatable.search($(this).val(), 'estate_type_id');
          });

          $('#city_id').on('change', function () {
            datatable.search($(this).val(), 'city_id');
          });

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
        if (key == 'building_city_name') {
          return 'مدينة المبنى';
        }
        if (key == 'building_number') {
          return 'رقم المبنى';
        }
        if (key == 'city_name') {
          return 'اسم المدينة';
        }
        if (key == 'created_at') {
          return 'تاريخ الطلب';
        }
        if (key == 'engagements') {
          return 'مبلغ الإلتزامات';
        }
        if (key == 'estate_price') {
          return 'سعر العقار';
        }
        if (key == 'estate_type_name') {
          return 'نوع العقار';
        }
        if (key == 'finance_interval') {
          return 'مبلغ التمويل';
        }
        if (key == 'is_first_home') {
          return 'اول منزل';
        }
        if (key == 'is subsidized property') {
          return 'هل العقار مدعوم';
        }
        if (key == 'job_start_date') {
          return 'تاريخ بدء العمل';
        }
        if (key == 'job_type') {
          return 'نوع العمل';
        }
        if (key == 'mobile') {
          return 'رقم الجوال';
        }
        if (key == 'name') {
          return 'الاسم';
        }
        if (key == 'national_address') {
          return 'العنوان الوطني';
        }
        if (key == 'street_name') {
          return 'اسم الشارع';
        }
        if (key == 'status') {
          return 'حالة الطلب';
        }

       return false;

      }
    </script>
@endpush
