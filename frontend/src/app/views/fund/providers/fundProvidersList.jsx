import React, { Component } from "react";
import { Breadcrumb, Loading } from "@gull";
import { formatDateTimeStamp, exportexcel, formatDate } from "@utils";
import swal from "sweetalert2";
import ReactPaginate from "react-paginate";
import { OverlayTrigger, Tooltip } from "react-bootstrap";
import { Link } from "react-router-dom";
import DateView from "react-datepicker";
import { getList } from './../../../services/fundProvidersService';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faWhatsapp } from '@fortawesome/free-brands-svg-icons';

class FundProvidersList extends Component {
  state = {
    pageTitle: '',
    rowsPerPage: 15,
    page: 1,
    pagesCount: 0,
    userList: [],
    showEditorDialog: false,
    searchQuery: "",
    dialogValues: null,
    loading: false,
    list: [],
    data: '',
    statusList: [
      {key: 'have_active', value: 'مفعل'},
      {key: 'waite_active', value: 'في انتظار التفعيل'},
      {key: 'best_providers', value: 'الأكثر نشاطاً'}
    ],

    page_number: 10, // limit items
    user_status: '',
    time: '',
    form_date: '',
    to_date: ''
  };


  updatePageData = () => {
    this.getItemsList(this.state.page_number, this.state.page);
  };

  // get items list
  getItemsList = async (limit, page) => {
    this.setState({ loading: true });
    getList(
      page,
      this.state.user_status,
      this.state.time,
      this.state.form_date,
      this.state.to_date,
      limit,
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

  handleSearch = ({ target: { value } }) => {
    this.setState({ searchQuery: value });
  };

  handlePageClick = data => {
    let page = data.selected + 1;
    this.setState({ page: page });
    setTimeout(() => {
      this.updatePageData();
    }, 200);
  };

  toggleEditorDialog = arg => {
    if (arg && arg.toString())
      this.setState({ showEditorDialog: arg, dialogValues: null });
    else
      this.setState({
        showEditorDialog: !this.state.showEditorDialog,
        dialogValues: null
      });
  };

  handleEditContact = dialogValues => {
    this.setState({ dialogValues, showEditorDialog: true });
  };

  handleDeleteContact = values => {
    // deleteUser(values).then(({ data: userList }) => {
    //   this.setState({ userList });
    //   swal.fire({
    //     title: "Deleted!",
    //     text: "Your file has been deleted.",
    //     type: "success",
    //     icon: "success",
    //     timer: 1500
    //   });
    // });
  };

  handleFormSubmit = async values => {
    // console.log(values);

    let { dialogValues } = this.state;
    let res;
    if (!dialogValues) {
      // res = await addNewUser(values);
    } else {
      // res = await updateUser({ ...dialogValues, ...values });
    }
    this.setState({ userList: res.data });
    this.toggleEditorDialog(false);
  };

  getBadgeColor = role => {
    switch (role) {
      case "0":
        return "danger";

      case "نعم":
        return "success";

      default:
        return "danger";
    }
  };

  componentDidMount() {
    this.updateContentByStatus();
  }

  updateContentByStatus() {
    const search = window.location.search;
    const params = new URLSearchParams(search);
    const status = params.get('status');

    const page = this.state.statusList.filter(el => {
      return el.key === status;
    });
    
    if(page[0]) {
      this.setState({pageTitle: page[0].value});
    } else {
      this.setState({pageTitle: "جميع العقاريين"});
    }
    if (status !== '') {
      this.setState({user_status: status});
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

  handleSearchInputChange = async (e) => {
    let searchQuery = e.currentTarget.value;

  };

  handlePageSizeChange = async (pageObj) => {

  };

  handleSearch = async () => {

  };
  onSearch = () => {
    this.getItemsList(this.state.page_number, 1);
  }


  render() {
    let {
      rowsPerPage,
      page,
      userList = [],
      list = [],
      pagesCount,
      dialogValues,
      searchQuery,
      showEditorDialog,
      loading,
      user_status,
      form_date,
      to_date,
      statusList,
      pageTitle
    } = this.state;

    userList = userList.filter(user =>
      user.name.toLowerCase().match(searchQuery.toLowerCase())
    );

    return (
      <div>
        <Breadcrumb
          routeSegments={[
            { name: "الرئيسية", path: "/" },
            { name: pageTitle }
          ]}
        ></Breadcrumb>
        {loading && <Loading></Loading>}

        <section className="contact-list">
          <div className="row">
            <div className="col-md-12 mb-4">
              <div className="card text-left">


                <div className="row px-4 mt-3">

                  <div className="col-sm-12 col-md-12 mb-2">
                    <div className="align-items-center row">
                    <div className="mr-1 mb-3 col-md-2">
                        <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">بحث بالآسم أو التاريخ </Tooltip>}>
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

                      {/* <div className="mr-1 col-md-2 mb-3">
                        <select className="form-control"
                          onChange={(e) => {
                            this.setState({
                              user_status: e.target.value
                            })
                          }}>
                          <option value=''>آختر الحالة</option>
                          {
                            statusList.map((item, i) => (
                              <option key={i} value={item.key}>{item.value}</option>
                            ))
                          }
                        </select>
                      </div> */}

                      <div className="mr-1 col-md-2 mb-3">
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
                      <button
                        type="button"
                        className="btn btn-primary btn-md mb-3"
                        onClick={this.onSearch}
                      > عرض النتائج</button>
                      <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">تصدير النتائج </Tooltip>}>
                        <button
                          type="button"
                          className="btn btn-outline-primary btn-md mb-3 ml-2"
                          onClick={() => exportexcel([], 'Providers_')}
                        >
                          <i className="i-File-Excel"></i>

                        </button>
                      </OverlayTrigger>

                    </div>
                  </div>
                </div>

                <div className="card-body pt-1">
                  <div className="table-responsive">
                    <table id="excel-table" className="display table w-100">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>اسم المكتب</th>
                          <th>اسم المالك</th>
                          <th>مشترك</th>
                          <th>حساب موثق</th>
                          <th>رقم الجوال</th>
                          <th>عدد العقارات</th>
                          <th>عدد العروض المرسلة</th>
                          <th>طلبات المعاينة</th>
                          <th>الطلبات المنفذة</th>
                          <th>الباقة</th>
                          <th>تاريخ بداية الاشتراك</th>
                          <th>تاريخ نهاية الاشتراك</th>
                          <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        {list
                          .slice(0, rowsPerPage)
                          .map((item, ind) => (
                            <tr key={ind}>
                              <td valign="middle">
                                <div className="ul-widget-app__profile-pic">
                                  {item.id}
                                </div>
                              </td>
                              <td>
                                <a href={item.link} target="_blank">

                                  <img
                                    className="profile-picture avatar-sm mb-2 p-2 img-fluid mr-2"
                                    src={item.logo ? item.logo : "/assets/images/default-logo.png"}
                                    onError={(e) => { e.target.onerror = null; e.target.src = "/assets/images/default-logo.png" }}
                                    alt=""
                                  />
                                  {item.onwer_name}
                                </a>
                              </td>
                              <td>{item.onwer_name}</td>
                              <td valign="middle">
                                <div
                                  className={`badge badge-${item.is_pay ? 'success' : 'danger'} p-2 text-capitalize`}
                                >
                                  {item.is_pay ? 'مشترك' : 'غير مشترك'}

                                </div>
                              </td>
                              <td valign="middle">
                                <div
                                  className={`badge badge-${item.is_certified ? 'success' : 'danger'} p-2 text-capitalize`}
                                >
                                  {item.is_certified ? 'موثق' : 'غير موثق'}

                                </div>
                              </td>
                              <td dir="ltr">{item.country_code}{item.mobile}
                                <a className="p-2 text-success" href={`https://wa.me/${item.country_code}${item.mobile}`} target="_blank" >
                                  <FontAwesomeIcon icon={faWhatsapp} />
                                </a>

                              </td>

                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              {/* <td>{item.count_agent}</td>
                              <td>{item.count_offer}</td>
                              <td>{item.count_request}</td>
                              <td>{item.count_visit}</td>
                              <td>{item.user_plan} </td>
                              <td>{formatDateTimeStamp(item.created_at)}</td>
                              <td>{formatDateTimeStamp(item.updated_at)}</td> */}

                              <td>
                                <div className="d-flex">
                                  <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض التفاصيل</Tooltip>}>
                                    <Link
                                      to={`/fund-providers/${item.id}`}
                                      type="button"
                                      className="btn btn-primary btn-md m-1 mt-3"
                                    >
                                      <i className="i-Eye"></i>

                                    </Link>
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
                        pageCount={Math.ceil(pagesCount / rowsPerPage)}
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
                            value={rowsPerPage}
                            className="form-control"
                            onChange={({ target: { value } }) => {
                              this.handlePageSizeChange({ value });
                            }}
                          // disabled={data.searchQuery !== "" ? "disabled" : ""}
                          >
                            <option value={5}>5</option>
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
              </div>
            </div>
          </div>
        </section>
      </div>
    );
  }
}

export default FundProvidersList;
