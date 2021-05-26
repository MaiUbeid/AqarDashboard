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

                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">


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
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">


                                        <div class="form-group">
                                            <label>{{__('views.area_estate')}}</label>
                                            <div class="" style=" text-align: right;">
                                                <select class="form-control" id="area_estate_id" style="display: inline-block;width: 82%;">
                                                    <option value="">{{__('views.choose')}}</option>
                                                    @if($estate_area)
                                                        @foreach($estate_area as $estate_areaItem)
                                                            <option value="{{$estate_areaItem->id}}">{{$estate_areaItem->area_range}}</option>

                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <label>{{__('views.area_price')}}</label>
                                            <div class="" style=" text-align: right;">

                                                <select class="form-control" id="estate_price_id" style="display: inline-block;width: 82%;">
                                                    <option value="">{{__('views.choose')}}</option>
                                                    @if($estate_price)
                                                        @foreach($estate_price as $estate_priceItem)
                                                            <option value="{{$estate_priceItem->id}}">{{$estate_priceItem->estate_price_range}}</option>

                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">


                                        <div class="form-group">
                                            <label>{{__('views.city')}}</label>
                                            <div class="" style=" text-align: right;">
                                                <select class="form-control" id="city_id" style="display: inline-block;width: 82%;">
                                                    <option value="">{{__('views.choose')}}</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <label>{{__('views.neighborhood')}}</label>
                                            <select multiple class="form-control" id="neighborhood_id" style="display: inline-block;width: 82%;">
                                                <option value="">{{__('views.choose')}}</option>


                                            </select></div>
                                    </div>
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

    <div class="modal fade" id="offer" tabindex="-1" role="dialog" aria-labelledby="offer" aria-hidden="true">
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



    <!-- end:: Content -->
@endsection

@push('css')
@endpush


@push('scripts')
    <script>

      $("#neighborhood_id").select2({

        width: "100%",
        language: "ar",
        minimumInputLength: 3,
        dir: "rtl",
        ajax: {
          url: "{{$select2_neighborhood}}",
          dataType: 'json',
          data: function (params) {
            return {
              q: params.term, // search term
              page: params.page,
              city_id: $('#city_id').val(),
            };
          },

          processResults: function (data, params) {
            console.log(data);
            params.page = params.page || 1;

            return {
              results: $.map(data.data, function (item) {

                return {
                  text: item.name_ar,
                  id: item.neighborhood_serial,
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

      $("#city_id").select2({

        width: "100%",
        language: "ar",
        minimumInputLength: 3,
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

                      console.log(data);
                      if (data.status == true) {

                        $('#reuqest .modal-body').html('');
                        var str = '';

                        $.map(data.data, function (key, value) {

                          str += '<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">' +
                            '<div class="form-group">' +
                            '<label>' + translation(value) + '</label>' +
                            '<input readonly="" value="' + key + '" type="text" class="form-control" id="kt_datepicker_1" readonly="" >' +
                            '</div> </div>';


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

                element.find('#request-model-offer').on('click', function (event) {
                  var element = $(this);
                  var id = element.attr('data-id');
                  var url = '{{route('admin.getOffer',':id')}}';
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

                      console.log(data);
                      if (data.status == true) {

                        $('#offer .modal-body').html('');
                        var str = '';

                        $.map(data.data[0], function (key, value) {


                          if (value != 'estate_note') {


                            if (value == 'estate_exclusive_contract_file' && key != null) {
                              str += '<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">' +
                                '<div class="form-group">' +
                                '<label>' + translation(value) + '</label>' +
                                '<img width="70px" src="' + key + '" alt="">' +
                                '</div> </div>';
                            } else {

                              if (key != null) {
                                str += '<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">' +
                                  '<div class="form-group">' +
                                  '<label>' + translation(value) + '</label>' +
                                  '<input readonly="" value="' + key + '" type="text" class="form-control" id="kt_datepicker_1" readonly="" >' +
                                  '</div> </div>';
                              }

                            }


                          }


                        });


                        $('#offer .modal-body').append(str);

                        $('#offer').modal('toggle');

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
                template: function (row, index, datatable) {
                  return '<button data-id="' + row.uuid + '" id="request-model" type="button" class="btn" onclick="alert()">\n' +
                    '                            <i class="far fa-share-alt mr-1"></i>\n' + row.uuid +
                    '                </button>';
                },

              },


              {
                field: 'offer_status',
                title: '{{__('views.offer_status')}}',
                sortable: false,
                width: 200,
                template: function (row, index, datatable) {
                  var str = '';
                  var ar = '';

                  //console.log(row.fund_request.offer_numbers, 'dddd');
                  if (row.fund_request.offer_numbers != null) {
                    ar = row.fund_request.offer_numbers.split(', ');
                  }
                  if (row.status == null && row.fund_request.offer_numbers && jQuery.inArray(row.id, ar)) {
                    str = 'تمت المشاهدة ولم يتم القبول';
                  } else if (row.status == 'active') {
                    str = 'تم قبول العرض من الصندوق';
                  } else if (row.status == 'customer_accepted') {
                    str = 'تم قبول العرض من العقاري';
                  } else {
                    str = 'لم يتم مشاهدة العرض';
                  }
                  return '<span class="badge badge-primary">' + str + '</span>';
                },

              },


              {
                field: 'estate_type_name',
                title: '{{__('views.estate_type')}}',
                sortable: false,

                template: function (row, index, datatable) {
                  return '<button data-id="' + row.id + '" id="request-model-offer" type="button" class="btn" >\n' +
                    '                            <i class="far fa-share-alt mr-1"></i>\n' + row.estate.estate_type_name +
                    '                </button>';
                },
              },

              {
                field: 'city_name',
                title: '{{__('views.city')}}',
                sortable: false,
                template: function (row, index, datatable) {
                  return row.estate.city_name;
                },

              },

              {
                field: 'neighborhood_name',
                title: '{{__('views.neighborhood')}}',
                template: function (row, index, datatable) {
                  return row.estate.neighborhood_name;
                },
              },

              {
                field: 'estate_price_range',
                title: '{{__('views.area_price')}}',
                sortable: false,
                template: function (row, index, datatable) {
                  return row.estate.total_price;
                },
              },
              {
                field: 'total_area',
                title: '{{__('views.total_area')}}',
                sortable: false,
                template: function (row, index, datatable) {
                  return row.estate.total_area;
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
          $('#area_estate_id').on('change', function () {
            datatable.search($(this).val(), 'area_estate_id');
          });
          $('#estate_price_id').on('change', function () {
            datatable.search($(this).val(), 'estate_price_id');
          });
          $('#city_id').on('change', function () {
            datatable.search($(this).val(), 'city_id');
          });
          $('#neighborhood_id').on('change', function () {
            datatable.search($(this).val(), 'neighborhood_id');
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

/////////////offer
        if (key == 'beneficiary_mobile') {
          return 'رقم المستفيد';
        }
        if (key == 'beneficiary_name') {
          return 'اسم المستفيد';
        }
        if (key == 'estate_bathrooms_number') {
          return 'عدد دوراة المياه';
        }
        if (key == 'estate_boards_number') {
          return ' عدد القاعات';
        }
        if (key == 'estate_city') {
          return 'اسم المدينة';
        }
        if (key == 'estate_dining_rooms_number') {
          return 'عدد غرف الطعام';
        }
        if (key == 'estate_estate_age') {
          return 'عمر العقار';
        }
        if (key == 'estate_exclusive_contract_file') {
          return 'العقد الحصري';
        }
        if (key == 'estate_finishing_type') {
          return 'نوع التفنيش';
        }
        if (key == 'estate_floor_number') {
          return 'عدد الطوابق';
        }
        if (key == 'estate_interface') {
          return 'واجهة العقار';
        }

        if (key == 'estate_is_checked') {
          return 'مفحوص';
        }
        if (key == 'estate_is_insured') {
          return 'موثق';
        }
        if (key == 'estate_is_resident') {
          return 'مقيم';
        }
        if (key == 'estate_kitchen_number') {
          return 'عدد المطابخ';
        }
        if (key == 'estate_lounges_number') {
          return 'عدد الصالات';
        }
        if (key == 'estate_meter_price') {
          return 'سعر المتر';
        }
        if (key == 'estate_neighborhood') {
          return 'اسم الحي';
        }
        if (key == 'estate_pace_number') {
          return 'رقم القطعة';
        }
        if (key == 'estate_planned_number') {
          return 'رقم الخطة';
        }

        if (key == 'estate_rooms_number') {
          return 'عدد الغرف';
        }
        if (key == 'estate_street_view') {
          return 'مساحة الشارع';
        }
        if (key == 'estate_total_area') {
          return 'مساحة العقار';
        }
        if (key == 'estate_total_price') {
          return 'سعر العقار';
        }
        if (key == 'guarantees') {
          return 'ضمانات';
        }
        if (key == 'instument_number') {
          return 'رقم الاقامة';
        }

        if (key == 'estate_id') {
          return 'رقم العقار';
        }


      }
    </script>
@endpush
