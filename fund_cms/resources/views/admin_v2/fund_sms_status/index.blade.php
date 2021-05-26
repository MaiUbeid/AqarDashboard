@extends('admin_v2.layout.app')

@section('content')
    <?php
    $time=null;
    $offer_status=null;
    if (isset($_GET['time'])) {
        $time = $_GET['time'];
    } else {
        $time = null;
    }


    if (isset($_GET['offer_status'])) {
        $offer_status = $_GET['offer_status'];
    } else {
        $offer_status = null;
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
                                            <label>{{__('حالة الطلب')}}</label>
                                            <div class="" style=" text-align: right;">
                                                <select class="form-control" id="status" style="display: inline-block;width: 82%;">
                                                    <option value="">{{__('views.choose')}}</option>

                                                            <option value="1">نجح الطلب</option>
                                                            <option value="0">فشل الطلب</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">


                                        <div class="form-group">
                                            <label>{{__('نوع العملية')}}</label>
                                            <div class="" style=" text-align: right;">
                                                <select class="form-control" id="type" style="display: inline-block;width: 82%;">
                                                    <option value="">{{__('views.choose')}}</option>

                                                    <option value="send_sms">ارسال رسالة العرض الاول</option>
                                                    <option value="send_code">ارسال كود</option>
                                                    <option value="check_code">التحقق من الكود</option>


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
                                            <select name="neighborhood_id[]" multiple class="form-control" id="neighborhood_id" style="display: inline-block;width: 82%;">
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
                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
        minimumInputLength: 1,
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
      @if($time)

        str = '?offer_status=' + '{{$offer_status}}' + '&time=' + '{{$time}}';

      @elseif($offer_status)
        str = '?offer_status=' + '{{$offer_status}}';
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
                  var url='{{route('admin.getRequest',':id')}}';
                  url=url.replace(':id',id);




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

                        var str='';

                        $.map(data.data, function (key,value) {

                     str   +='<div class="col-md-12 kt-margin-b-20-tablet-and-mobile">'+
                            '<div class="form-group">'+
                            '<label>'+translation(value)+'</label>'+
                            '<input readonly="" value="'+key+'" type="text" class="form-control" id="kt_datepicker_1" readonly="" >'+
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
              },
            },


            // columns definition
            columns: [
              {
                field: 'id',
                title: '{{__('ID')}}',
                sortable: false,
              },
              {
                field: 'uuid',
                title: '{{__('views.uuid')}}',
                sortable: false,
                template: function (row, index, datatable) {
                  return '<button data-id="'+row.uuid+'" id="request-model" type="button" class="btn" onclick="alert()">\n' +
                    '                            <i class="far fa-share-alt mr-1"></i>\n' +row.uuid+
                    '                </button>';
                },

              },


              {
                field: 'estate_type_name',
                title: '{{__('views.estate_type')}}',
                sortable: false,
                template: function (row, index, datatable) {
                  return row.fund_request_name.estate_type_name;
                },
              },

              {
                field: 'city_name',
                title: '{{__('اسم المدينة')}}',
                sortable: false,
                template: function (row, index, datatable) {
                  return row.fund_request_name.city_name;
                },
              },

              {
                field: 'neighborhood_name',
                title: '{{__('اسماء الاحياء')}}',
                sortable: false,
                template: function (row, index, datatable) {
                  return row.fund_request_name.neighborhood_name;
                },
              },



              {
                field: 'type',
                title: '{{__('نوع الاتصال')}}',
                sortable: false,
                width: 200,
                template: function (row, index, datatable) {
                  var str = '';
                  var ar = '';

                  if (row.type == 'send_sms') {
                    str = 'رسالة العرض الاول';
                  } else if (row.type == 'send_code') {
                    str = 'ارسال الكود';
                  } else if (row.type == 'check_code') {
                    str = 'التحقق من الكود';
                  } else {
                    str = 'لم يتم الاتصال';
                  }
                  return '<span class="badge badge-primary">' + str + '</span>';
                },

              },

              {
                field: 'status',
                title: '{{__('حالة العملية')}}',
                sortable: false,
                width: 200,
                template: function (row, index, datatable) {
                  var str = '';
                  var ar = '';
                  var class_name = '';

                  if (row.status == 0) {
                    str = 'فشل الطلب';
                    class_name='badge-danger'
                  } else if (row.status == 1) {
                    str = 'نجح الطلب';
                    class_name = 'badge-primary';

                  }
                  return '<span class="badge '+class_name+'">' + str + '</span>';
                },

              },


              {
                field: 'error_msg',
                title: '{{__('الرسالة')}}',
                sortable: false,
                template: function (row, index, datatable) {
                  return row.error_msg;
                },
              },


              {
                field: 'code',
                title: '{{__('الكود')}}',
                sortable: false,
                template: function (row, index, datatable) {
                  return row.code;
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
          $('#status').on('change', function () {
            datatable.search($(this).val(), 'status');
          });
          $('#type').on('change', function () {
            datatable.search($(this).val(), 'type');
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

  if(key=='id')
  {
    return 'الرقم'
  }
  if(key=='uuid')
  {
    return 'رقم الطلب'
  }
  if(key=='estate_type_id')
  {
    return 'رقم نوع العقار'
  }
  if(key=='estate_status')
  {
    return 'حالة العقار'
  }
  if(key=='area_estate_id')
  {
    return 'رقم المساحة'
  }
  if(key=='dir_estate_id')
  {
    return 'رقم الاتجاه'
  }
  if(key=='estate_price_id')
  {
    return 'رقم السعر'
  }
  if(key=='street_view_id')
  {
    return 'رقم مساحة الشارع'
  }
  if(key=='city_id')
  {
    return 'رقم المدينة'
  }
  if(key=='neighborhood_id')
  {
    return 'رقم الحي'
  }
  if(key=='rooms_number_id')
  {
    return 'رقم عدد الغرف'
  }
  if(key=='created_at')
  {
    return 'تاريخ الانشاء'
  }
  if(key=='estate_type_icon')
  {
    return 'صورة نوع العقار'
  }
  if(key=='estate_type_name')
  {
    return 'نوع العقار'
  }
  if(key=='dir_estate')
  {
    return 'اتجاه العقار'
  }
  if(key=='street_view_range')
  {
    return 'مدى مساحة الشارع'
  }
  if(key=='estate_price_range')
  {
    return 'مدى السعر'
  }
  if(key=='area_estate_range')
  {
    return 'مدى المساحة'
  }
  if(key=='city_name')
  {
    return 'اسم المدينة'
  }
  if(key=='neighborhood_name')
  {
    return 'اسم الحي'
  }


}
    </script>
@endpush
