import React, { Component } from "react";
import { Breadcrumb } from "@gull";
import swal from "sweetalert2";
import { formatDate, exportexcel } from "@utils";
import ReactPaginate from "react-paginate";
import { OverlayTrigger, Tooltip } from "react-bootstrap";
import { Link } from "react-router-dom";
import DateView from "react-datepicker";
import { getUsersList, setUserActivationStatus } from './../../../services/adminServices';
import { Loading } from "@gull";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faWhatsapp } from '@fortawesome/free-brands-svg-icons';

class UsersList extends Component {
  state = {
    rowsPerPage: 15,
    pagesCount: 0,
    userList: [],
    showEditorDialog: false,
    searchQuery: "",
    dialogValues: null,
    loading: false,
    list: [],
    data: '',

    page: 1,
    status: '',
    type: '',
    page_number: 10, // limit items
    search: '',
    form_date: '',
    to_date: '',
    is_verified: ''
  };


  updatePageData = () => {
    this.getItemsList(this.state.page_number, this.state.page);
  };

  // get items list
  getItemsList = async (limit, page) => {
    this.setState({ loading: true });
    getUsersList(
      page,
      this.state.status,
      this.state.type,
      limit,
      this.state.search,
      this.state.form_date,
      this.state.to_date,
      this.state.is_verified,
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

  handleUserActivation = async (currentStatus, id, status) => {
    let body = {
      id: id,
      status: (currentStatus !== '1' ? 'active' : 'not_active')
    };
    swal.fire({
      title: currentStatus !== '1' ? 'تأكيد تفعيل أشتراك المستخدم؟' : 'هل تريد الغاء تفعيل الأشتراك؟',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: `تأكيد`,
      denyButtonText: `إلغاء`,
      cancelButtonText: `إلغاء`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        setUserActivationStatus(body);
        swal.fire('تم حفظ التغييرات!', '', 'success');
        this.getItemsList(this.state.page_number, 1);

      } else if (result.isDenied) {
        // swal.fire('لم يتم تغيير', '', 'info')
      }
    })

  }

  onSearch = () => {
    this.getItemsList(this.state.page_number, 1);
  }

  handleFormSubmit = async values => {

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
    this.updatePageData();
  }

  componentDidUpdate() {
    // this.updatePageData();
  }

  handleSearchInputChange = async (e) => {
    let searchQuery = e.currentTarget.value;

  };

  handlePageSizeChange = async (pageObj) => {
    this.setState({ page: 1, page_number: pageObj.value });
    this.getItemsList(pageObj.value, 1);
  };

  render() {
    let {
      page_number,
      page,
      userList = [],
      list = [],
      form_date,
      to_date,
      pagesCount,
      dialogValues,
      searchQuery,
      showEditorDialog,
      loading
    } = this.state;

    userList = userList.filter(user =>
      user.name.toLowerCase().match(searchQuery.toLowerCase())
    );

    return (
      <div>
        <Breadcrumb
          routeSegments={[
            // { name: "الرئيسية", path: "/" },
            { name: "قائمة المستخدمين" }
          ]}
        ></Breadcrumb>

        <section className="contact-list">
          <div className="row">
            <div className="col-md-12 mb-4">
              <div className="card text-left">


                <div className="row px-4 mt-3">

                  <div className="col-sm-12 col-md-12 mb-2">
                    <div className="align-items-center row">
                      <div className="mr-1 mb-3 col-md-2">
                        <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">بحث بأسم أو التاريخ </Tooltip>}>
                          <input
                            type="search"
                            className="form-control"
                            onChange={this.handleSearchInputChange}
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
                            this.setState({ status: e.target.value });
                          }}>
                          <option value=''>آختر الحاله</option>
                          {
                            [{ id: 'active', name: 'نشط' }, { id: 'not_active', name: 'غير نشط' }].map((item, i) => (
                              <option key={i} value={item.id}>{item.name}</option>
                            ))
                          }
                        </select>
                      </div>

                      <div className="mr-1 col-md-2 mb-3">

                        <select className="form-control"
                          onChange={(e) => {
                            this.setState({ type: e.target.value });
                          }}>
                          <option value=''>آختر النوع</option>
                          {
                            [{ id: 'user', name: 'مستخدم' }, { id: 'provider', name: 'عقاري' }].map((item, i) => (
                              <option key={i} value={item.id}>{item.name}</option>
                            ))
                          }
                        </select>
                      </div>

                      <div className="mr-1 col-md-2 mb-3">

                        <select className="form-control"
                          onChange={(e) => {
                            this.setState({ is_verified: e.target.value });
                          }}>
                          <option value=''>حالة التفعيل</option>
                          {
                            [{ id: '1', name: 'مفعل' }, { id: '0', name: 'غير مفعل' }].map((item, i) => (
                              <option key={i} value={item.id}>{item.name}</option>
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
                          onClick={() => exportexcel('admin-users_')}
                        >
                          <i className="i-File-Excel"></i>

                        </button>
                      </OverlayTrigger>

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
                              <th>ID</th>
                              <th>اسم المكتب</th>
                              <th>اسم المالك</th>
                              <th>الحاله</th>
                              <th>مشترك</th>
                              <th>حساب موثق</th>
                              <th>رقم الجوال</th>
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
                                      {item.name}
                                    </a>
                                  </td>
                                  <td>{item.onwer_name}</td>
                                  <td valign="middle">
                                    <div
                                      className={`badge badge-${item.status === 'active' ? 'success' : 'danger'} p-2 text-capitalize`}
                                    >
                                      {item.status === 'active' ? 'مفعل' : 'غير مفعل'}

                                    </div>
                                  </td>
                                  <td>

                                    <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">{item.is_pay == '1' ? 'الغاء تفعيل الأشتراك' : 'تفعيل الأشتراك'}</Tooltip>}>
                                      <button
                                        onClick={() => this.handleUserActivation(item.is_pay, item.id, 1)}
                                        type="button"
                                        className={`btn-sm btn btn-${item.is_pay !== '1' ? 'danger' : 'success'} btn-md m-1 mt-3`}
                                      >
                                        <i className={`i-${item.is_pay !== '1' ? 'Unlike' : 'Like'} m-1`}></i>
                                        {item.is_pay == '1' ? 'مشترك' : 'غير مشترك'}

                                      </button>
                                    </OverlayTrigger>

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
                                  <td>
                                    <div className="d-flex">
                                      <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض التفاصيل</Tooltip>}>
                                        <Link
                                          to={`/user/${item.id}`}
                                          type="button"
                                          className="btn-sm btn btn-primary btn-md m-1 mt-3"
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

export default UsersList;
