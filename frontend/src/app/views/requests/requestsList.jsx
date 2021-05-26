import React, { Component } from "react";
import { Breadcrumb } from "@gull";
import { formatDate, exportexcel, formatDateTimeStamp } from "@utils";
import ReactPaginate from "react-paginate";
import { OverlayTrigger, Tooltip, Alert } from "react-bootstrap";
import DateView from "react-datepicker";
import { getList } from '../../services/requestsService';
import {
  getCities,
  getStates,
  getNeighborhood,
  geAreaList,
  geTypeList,
  gePriceList
} from '../../services/settingsServcie';
import { Loading } from "@gull";
import { Typeahead } from 'react-bootstrap-typeahead';
import LoadingButton from "@gull/components/buttons/LoadingButton";

class requestsList extends Component {
  state = {
    pageTitle: '',
    exportAllLoading: false,
    page: 1,
    pagesCount: 0,
    loading: false,
    list: [],
    data: '',
    states: [
      {
        value: "الرياض",
        id: 1
      }
    ],
    cities: [],
    neighborhood: [],
    typeList: [],
    areaList: [],
    priceList: [],

    offer_status: '',
    page_number: 10, // limit items
    search: '',
    status: '',
    time: '',
    state_id: '',
    estate_type_id: '',
    area_estate_id: '',
    dir_estate_id: '',
    estate_price_id: '',
    city_id: '',
    neighborhood_id: '',
    form_date: '',
    to_date: '',
    uuid: '',
    statusList: [
      { key: 'have_offers', value: 'طلبات استقبلت عروض' },
      { key: 'have_active_offers', value: 'طلبات المعاينة' },
      { key: 'dont_have_active_offers', value: 'طلبات بدون عروض' },
      { key: 'complete', value: 'طلبات منفذة' },
      { key: 'rejected_customer', value: 'طلبات مرفوضة' }
    ],
  };


  updatePageData = () => {
    getStates().then(res => {
      this.setState({ states: res.data.data });
    });

    geAreaList().then(res => {
      this.setState({ areaList: res.data.data });
    });

    geTypeList().then(res => {
      this.setState({ typeList: res.data.data });
    });

    gePriceList().then(res => {
      this.setState({ priceList: res.data.data });
    });
    this.getItemsList(this.state.page_number, this.state.page);
  };

  // get items list
  getItemsList = async (limit, page) => {
    this.setState({ loading: true });
    getList(
      page,
      this.state.state_id,
      this.state.offer_status,
      this.state.time,
      this.state.estate_type_id,
      this.state.area_estate_id,
      this.state.dir_estate_id,
      this.state.estate_price_id,
      this.state.city_id,
      this.state.neighborhood_id,
      this.state.form_date,
      this.state.to_date,
      limit,
      this.state.uuid
    ).then(res => {
      let list = [...res.data.data.data];
      this.setState({
        list: [...list],
        page: res.data.data.current_page,
        pagesCount: res.data.data.total,
        loading: false
      })
    });
  }

  onStatesChange = (e) => {
    if (e !== '') {
      getCities(e).then(res =>
        this.setState({
          cities: res.data.data
        })
      );
    } else {
      this.setState({
        neighborhood_id: [],
        cities: []
      })
    }
  };

  onCitiesChange = (e) => {
    if (e[0] && e[0].serial_city) {
      getNeighborhood(e[0].serial_city).then(res => {
        this.setState({
          neighborhood: res.data.data,
          city_id: e[0].serial_city
        })
      });
    } else {
      this.setState({
        neighborhood_id: [],
        cities: []
      })
    }
  };

  onNeighborhoodChange = (e) => {
    let list = [];
    e.forEach(element => {
      list.push(element.neighborhood_serial);
    });
    this.setState({ neighborhood_id: list });
  };

  handlePageClick = data => {
    let page = data.selected + 1;
    this.setState({ page: page });
    setTimeout(() => {
      this.getItemsList(this.state.page_number, page);
    }, 200);
  };

  getBadgeColor = role => {
    switch (role) {
      case "جديد":
        return "primary";

      case "مستعمل":
        return "success";

      default:
        return "primary";
    }
  };

  componentDidMount() {
    this._ismounted = true;
    this.updateContentByStatus();
  }

  updateContentByStatus() {
    const search = window.location.search;
    const params = new URLSearchParams(search);
    const status = params.get('status');

    const page = this.state.statusList.filter(el => {
      return el.key === status;
    });

    if (page[0]) {
      this.setState({ pageTitle: page[0].value });
    } else {
      this.setState({ pageTitle: "جميع الطلبات" });
    }
    if (status !== '') {
      this.setState({ offer_status: status });
      setTimeout(() => {
        this.updatePageData();
      }, 100);
    } else {
      setTimeout(() => {
        this.updatePageData();
      }, 100);
    }
  }

  componentWillUnmount() {
    this._ismounted = false;
  }

  componentDidUpdate(prevProps) {
    if (this.props.location.search !== prevProps.location.search) {
      this.updateContentByStatus();
    }
  }

  handlePageSizeChange = async (pageObj) => {
    this.setState({ page: 1, page_number: pageObj.value });
    this.getItemsList(pageObj.value, 1);
  };

  onSearch = () => {
    this.getItemsList(this.state.page_number, 1);
  }

  exportAllData = async () => {
    this.setState({ exportAllLoading: true });
    getList(
      1,
      this.state.state_id,
      this.state.offer_status,
      this.state.time,
      this.state.estate_type_id,
      this.state.area_estate_id,
      this.state.dir_estate_id,
      this.state.estate_price_id,
      this.state.city_id,
      this.state.neighborhood_id,
      this.state.form_date,
      this.state.to_date,
      this.state.pagesCount,
      this.state.uuid
    ).then(res => {
      let list = [...res.data.data.data];
      let exportList = [];
      list.forEach(element => {
        exportList.push({
          uuid: element.uuid,
          estate_type_name_web: element.estate_type_name_web,
          city_name: element.city_name,
          date: formatDateTimeStamp(element.created_at),
          status_name: element.status_name,
          neighborhood_name: element.neighborhood_name,
          estate_price_range: element.estate_price_range,
          area_estate_range: element.area_estate_range
        });
      });
      exportexcel(exportList, `Requests_${this.state.offer_status}_`);
      this.setState({ exportAllLoading: false });

    });
  }

  render() {
    let {
      offer_status,
      search,
      page_number,
      page,
      list = [],
      form_date,
      to_date,
      pagesCount,
      loading,
      states,
      cities,
      neighborhood,
      typeList,
      areaList,
      priceList,
      exportAllLoading,
      statusList,
      pageTitle
    } = this.state;

    return (
      <div>
        <Breadcrumb
          routeSegments={[
            { name: "الرئيسية", path: "/" },
            { name: pageTitle }
          ]}
        ></Breadcrumb>

        <section className="contact-list">
          <div className="row">
            <div className="col-md-12 mb-4">
              <div className="card text-left">
                <div className="row px-4 mt-3">

                  <div className="col-sm-12 col-md-12 mb-2">
                    <div className="align-items-center row">
                      <div className="mr-1 mb-3 col-md-4">
                        <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">بحث بال UUID </Tooltip>}>
                          <input
                            type="search"
                            className="form-control"
                            aria-controls="ul-contact-list"
                            placeholder="أكتب رقم ال UUID للبحث "
                            onKeyUp={(e) => {
                              this.setState({ uuid: e.target.value });
                            }}
                          />
                        </OverlayTrigger>
                      </div>
                    </div>
                    <div className="align-items-center row">
                      <div className="mr-1 mb-3 col-md-2">
                        <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">بحث بنوع العقار أو التاريخ </Tooltip>}>
                          <input
                            type="search"
                            className="form-control"
                            aria-controls="ul-contact-list"
                            placeholder="بحث"
                            onKeyUp={(e) => {
                              this.setState({ search: e.target.value });
                            }}
                          />
                        </OverlayTrigger>
                      </div>
                      <div className="mr-1 col-md-2 mb-3">

                        <select className="form-control"
                          onChange={(e) => {
                            this.setState({ estate_type_id: e.target.value });
                          }}>
                          <option value=''>آختر نوع العقار</option>
                          {
                            typeList.map((item, i) => (
                              <option key={i} value={item.id}>{item.name_ar}</option>
                            ))
                          }
                        </select>
                      </div>
                      <div className="mr-1 col-md-2 mb-3">
                        <select className="form-control"
                          onChange={(e) => {
                            this.setState({ area_estate_id: e.target.value });
                          }}>
                          <option value=''>آختر المساحة</option>
                          {
                            areaList.map((item, i) => (
                              <option key={i} value={item.id}>{item.area_range}</option>
                            ))
                          }
                        </select>
                      </div>
                      <div className="col-md-2 mb-3">
                        <div className="input-group">
                          <span className="w-50">
                            <DateView
                              dateFormat="yyyy-MM-dd"
                              autoComplete="off"
                              id="startDate"
                              className="rounded-0 form-control d-inline"
                              placeholderText="من تاريخ"
                              maxDate={new Date()}
                              onChange={(val) =>
                                this.setState({ form_date: formatDate(val) })
                              }
                              value={form_date}
                            />
                          </span>
                          <span className="w-50">
                            <DateView
                              dateFormat="yyyy-MM-dd"
                              autoComplete="off"
                              id="endtDate"
                              className="rounded-0 form-control d-inline"
                              placeholderText="حتى تاريخ"
                              maxDate={new Date()}
                              onChange={(val) =>
                                this.setState({ to_date: formatDate(val) })
                              }
                              value={to_date}
                            />
                          </span>
                        </div>

                      </div>

                    </div>
                    <div className="align-items-center row">
                      {/* <div className="mr-1 col-md-1 mb-3">
                        <select className="form-control"
                          onChange={(e) => {
                            this.setState({
                              offer_status: e.target.value
                            })
                          }}>
                          <option value=''>الحالة</option>
                          {
                            statusList.map((item, i) => (
                              <option key={i} value={item.key}>{item.value}</option>
                            ))
                          }
                        </select>
                      </div> */}

                      <div className="mr-1 col-md-2 mb-3">
                        <select className="form-control"
                          onChange={(e) => {
                            this.setState({ estate_price_id: e.target.value });
                          }}>
                          <option value=''>السعر</option>
                          {
                            priceList.map((item, i) => (
                              <option key={i} value={item.id}>{item.estate_price_range}</option>
                            ))
                          }
                        </select>
                      </div>
                      <div className="mr-1 col-md-2 mb-3">
                        <select className="form-control"
                          onChange={(e) => {
                            this.setState({ state_id: e.target.value })
                            this.onStatesChange(e.target.value);
                          }}>
                          <option value=''>آختر المنطقة</option>
                          {
                            states.map((item, i) => (
                              <option key={i} value={item.id}>{item.value}</option>
                            ))
                          }
                        </select>
                      </div>
                      <div className="mr-1 col-md-2 mb-3">
                        <Typeahead
                          id="basic-typeahead-single"
                          labelKey="name"
                          onChange={(e) => {
                            this.onCitiesChange(e);
                          }}
                          options={cities}
                          placeholder="آختر المدينة"
                          disabled={cities.length < 1}
                        />
                      </div>
                      <div className="mr-1 col-md-2 mb-3">
                        <Typeahead
                          id="basic-typeahead-single"
                          labelKey="name_ar"
                          onChange={(e) => {
                            this.onNeighborhoodChange(e);
                          }}
                          options={neighborhood}
                          placeholder="آختر الاحياء"
                          disabled={neighborhood.length < 1}
                          multiple
                        />
                      </div>

                      <button
                        type="button"
                        className="btn btn-primary btn-md mb-3"
                        onClick={this.onSearch}
                      >
                        عرض النتائج
                      </button>
                      <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">تصدير النتائج </Tooltip>}>
                        <button
                          type="button"
                          className="btn btn-outline-primary btn-md mb-3 ml-2"
                          onClick={() => exportexcel([], 'Requests_')}
                        >
                          <i className="i-File-Excel"></i>

                        </button>
                      </OverlayTrigger>


                      <LoadingButton
                        className="btn btn-primary btn-md mb-3 ml-2"
                        loading={exportAllLoading}
                        animation="border"
                        spinnerSize="sm"

                      >
                        {!exportAllLoading && <span onClick={() => this.exportAllData()}>
                          <i className="i-File-Excel m-1"></i>
                          تصدير الكل
                        </span>}
                        {exportAllLoading && <span>جاري التصدير..</span>}
                      </LoadingButton>

                    </div>
                  </div>
                </div>
                {loading && <Loading></Loading>}
                <div className={`card-body pt-1 ${loading ? 'invisible' : 'visible'}`}>
                  {pagesCount > 0
                    ? <div>
                      <div className="table-responsive">
                        <table id="excel-table" className="display table w-100">
                          <thead>
                            <tr>
                              <th width="300">UUID</th>
                              <th>نوع العقار</th>
                              <th>المدينة</th>
                              <th width="100">تاريخ الارسال</th>
                              <th>الحالة</th>
                              <th>الحي</th>
                              <th>السعر</th>
                              <th>المساحة المطلوبة</th>
                              <th>العمليات</th>
                            </tr>
                          </thead>
                          <tbody>
                            {list
                              .slice(0, page_number)
                              .map((item, ind) => (
                                <tr key={ind}>
                                  <td valign="middle">
                                    <div className="ul-widget-app__profile-pic">
                                      {item.uuid}
                                    </div>
                                  </td>
                                  <td>
                                    <img
                                      className="profile-picture avatar-sm mb-2 p-2 img-fluid mr-2"
                                      src={item.estate_type_icon}
                                      alt=""
                                    />
                                    {item.estate_type_name_web}</td>
                                  <td>{item.city_name}</td>
                                  <td>{formatDateTimeStamp(item.created_at)}</td>

                                  <td valign="middle">
                                    <div
                                      className={`badge badge-${this.getBadgeColor(
                                        item.estate_status
                                      )} p-2 text-capitalize`}
                                    >
                                      {item.estate_status}
                                    </div>
                                  </td>
                                  <td>{item.neighborhood_name}</td>
                                  <td>{item.estate_price_range}</td>
                                  <td>{item.area_estate_range}</td>
                                  <td>
                                    <div className="d-flex">
                                      <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض التفاصيل</Tooltip>}>

                                        <button onClick={() => this.props.history.push(`/request/${item.id}`)}
                                          className="btn btn-light btn-md m-1 mt-3"
                                        >
                                          <i className="i-Eye"></i>
                                        </button>
                                      </OverlayTrigger>
                                    </div>
                                  </td>
                                </tr>
                              ))}
                          </tbody>
                        </table>
                      </div>
                      <div className="d-flex justify-content-end mr-lg-4">
                        <div className="col-sm-12 col-md-6 mb-2">

                          <ReactPaginate
                            previousLabel={"السابق"}
                            nextLabel={"التالي"}
                            breakLabel={"..."}
                            breakClassName={"break-me"}
                            pageCount={Math.ceil(pagesCount / page_number)}
                            marginPagesDisplayed={2}
                            pageRangeDisplayed={3}
                            onPageChange={this.handlePageClick}
                            containerClassName={"pagination pagination-lg"}
                            subContainerClassName={"pages pagination"}
                            activeClassName={"active"}
                          />
                        </div>
                        <div className="col-sm-12 col-md-6 mb-2">
                          <div className="d-flex align-items-center float-right">
                            <span className="mr-1">عناصر</span>
                            <div className="mr-1">
                              <select
                                value={page_number}
                                className="form-control"
                                onChange={({ target: { value } }) => {
                                  this.handlePageSizeChange({ value });
                                }}
                              >
                                <option value={10}>10</option>
                                <option value={25}>25</option>
                                <option value={50}>50</option>
                                <option value={100}>100</option>
                                <option value={pagesCount}>الكل</option>
                              </select>
                            </div>
                            <span>عرض</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    : <div className="alert alert-info">
                      لا يوجد بيانات
                    </div>}
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    );
  }
}
export default requestsList;
