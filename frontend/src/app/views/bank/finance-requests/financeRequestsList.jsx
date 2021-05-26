import React, { Component } from "react";
import { Breadcrumb } from "@gull";
import { formatDate, exportexcel, formatDateTimeStamp } from "@utils";
import ReactPaginate from "react-paginate";
import { OverlayTrigger, Tooltip, Alert } from "react-bootstrap";
import DateView from "react-datepicker";
import { getFinanceRequestsList, getFinanceDetails, updateFinanceStatus } from '../../../services/bankServcies';
import {
    getCities,
    getStates,
    getNeighborhood,
    geAreaList,
    geTypeList
} from '../../../services/settingsServcie';
import { Loading } from "@gull";
import { Typeahead } from 'react-bootstrap-typeahead';

class financeRequestsList extends Component {
    state = {
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
        typeList: [],

        status: '',
        estate_type_id: '',
        city_id: '',
        form_date: '',
        to_date: '',
        state_id: '',
        page_number: 10,  // limit items
        search: '',
        page: 1
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

        this.getItemsList(this.state.page_number, this.state.page);
    };

    // get items list
    getItemsList = async (limit, page) => {
        this.setState({ loading: true });
        getFinanceRequestsList(
            this.state.status,
            this.state.estate_type_id,
            this.state.city_id,
            this.state.form_date,
            this.state.to_date,
            this.state.state_id,
            limit,
            this.state.search,
            page
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
                    cities: res.data.data,
                    state_id: e
                })
            );
        } else {
            this.setState({
                cities: []
            })
        }
    };

    onCitiesChange = (e) => {
        if (e[0] && e[0].serial_city) {
            getNeighborhood(e[0].serial_city).then(res => {
                this.setState({
                    city_id: e[0].serial_city
                })
            });
        } else {
            this.setState({
                cities: []
            })
        }
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
        this.updatePageData();
    }

    componentWillUnmount() {
        this._ismounted = false;
    }

    componentDidUpdate() {
        // this.updatePageData();
    }

    handlePageSizeChange = async (pageObj) => {
        this.setState({ page: 1, page_number: pageObj.value });
        this.getItemsList(pageObj.value, 1);
    };

    onSearch = () => {
        this.getItemsList(this.state.page_number, 1);
    }

    render() {
        let {
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
            typeList,
        } = this.state;

        return (
            <div>
                <Breadcrumb
                    routeSegments={[
                        { name: "الرئيسية", path: "/" },
                        { name: "قائمة التمويل" }
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
                                            >عرض النتائج</button>
                                            <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">تصدير النتائج </Tooltip>}>
                                                <button
                                                    type="button"
                                                    className="btn btn-outline-primary btn-md mb-3 ml-2"
                                                    onClick={() => exportexcel('finance_Requests_')}
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
                                                            <th>رقم الطلب</th>
                                                            <th>اسم العميل</th>
                                                            <th>نوع العقار</th>
                                                            <th>المدينة</th>
                                                            <th width="100">تاريخ الانشاء</th>
                                                            <th>الحالة</th>
                                                            <th>اسم البنك</th>
                                                            <th>الراتب محول لبنك الرياض؟</th>
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
                                                                        {item.name}</td>
                                                                    <td>{item.estate_type.name_ar}</td>
                                                                    <td>{item.city_name}</td>
                                                                    <td>{formatDateTimeStamp(item.created_at)}</td>

                                                                    <td>{item.status == '0' ? 'نشط': 'غير نشط'}</td>
                                                                    <td>{item.bank.name_ar}</td>
                                                                    <td valign="middle"> </td>
                                                                    <td>
                                                                        <div className="d-flex">
                                                                            <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض التفاصيل</Tooltip>}>

                                                                                <button onClick={() => this.props.history.push(`/finance-requests/${item.id}`)}
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

export default financeRequestsList;