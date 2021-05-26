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

                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">


                                        <div class="form-group">
                                            <label>{{__('views.estate_type')}}</label>
                                            <div class="" style=" text-align: right;">
                                                <select class="form-control" id="estate_type_id" style="display: inline-block;width: 82%;">
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
                                                    @if($estate_area)
                                                        @foreach($estate_area as $estate_areaItem)
                                                            <option value="{{$estate_areaItem->id}}">{{$estate_areaItem->name}}</option>

                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                            <div class="form-group">
                                                <label>إلى تاريخ:</label>
                                                <input type="text" class="form-control" id="kt_datepicker_2" readonly="" placeholder="اختر تاريخ ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">


                                        <div class="form-group">
                                            <label>{{__('views.city')}}</label>
                                            <div class="" style=" text-align: right;">
                                                <select class="form-control" id="city_id" style="display: inline-block;width: 82%;">
                                                    <option value="">{{__('views.choose')}}</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <label>{{__('views.neighborhood')}}</label>
                                            <select class="form-control" id="neighborhood_id" style="display: inline-block;width: 82%;">
                                                <option value="">{{__('views.choose')}}</option>


                                            </select></div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <label>إلى تاريخ:</label>
                                            <input type="text" class="form-control" id="kt_datepicker_2" readonly="" placeholder="اختر تاريخ ">
                                        </div>
                                    </div>


                                    <div class="row align-items-center">


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

                    // columns definition
                    columns: [
                      {
                        field: 'id',
                        title: '#',
                        sortable: false,
                        width: 20,
                        selector: {
                          class: 'kt-checkbox--solid',
                        },
                        textAlign: 'center',
                      },

                      {
                        field: 'created_at',
                        sortable: false,
                        title: '{{__('views.Date of Creation')}}',
                        template: function (row, index, datatable) {
                          return moment(row.created_at).format("YYYY/MM/DD HH:mm");
                        },
                      }, {
                        field: "Actions",
                        width: 80,
                        title: "{{__('views.Actions')}}",
                        sortable: false,
                        autoHide: false,
                        overflow: 'visible',
                        template: function (row) {
                          var edit_url = '{{$edit_url}}'.replace('0', row.id);

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
                        <span class="kt-nav__link-text">{{__('views.Edit')}}</span>\
                      </a>\
                    </li>\
                  </ul>\
                </div>\
              </div>\
            ';
                        },
                      }],
                  });
                };

                // search
                var search = function () {
                  $('#kt_form_status').on('change', function () {
                    datatable.search($(this).val().toLowerCase(), 'Status');
                  });
                };


                var filter = function () {

                  $('#filter_by_status').on('change', function () {
                    datatable.search($(this).val(), 'status');
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
                    search();
                    selection();

                    updateTotal();
                  },
                };
              }();

              // On document ready
              KTUtil.ready(function () {
                KTUserListDatatable.init();
              });
            </script>
    @endpush
