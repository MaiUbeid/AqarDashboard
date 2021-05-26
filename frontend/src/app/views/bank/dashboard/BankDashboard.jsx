import React, { Component } from "react";
import ComparisonChart from "app/views/charts/echarts/ComparisonChart";
import SimpleCard from "@gull/components/cards/SimpleCard";
import { OverlayTrigger, Tooltip, Alert, Dropdown } from "react-bootstrap";

import { Link } from "react-router-dom";
import { useTranslation, withTranslation, Trans } from 'react-i18next';
import { getList, getDashMap, getDashYear } from './../../../services/fundSettingsServcie';
import { Loading } from "@gull";
import MapVector from "./../../../GullLayout/SharedComponents/MapVector";


class BankDashboard extends Component {
  state = {
    cardList1: [
      {
        icon: "i-Checkout-Basket",
        title: '',
        subtitle: "كل العروض المرسلة",
        link: '/fund/offers'
      },
      {
        icon: "i-Financial",
        title: '',
        subtitle: "طلبات دون عروض",
        link: '/fund/requests'
      },
      {
        icon: "i-Money-2",
        title: '',
        subtitle: "طلبات لها عروض",
        link: '/fund/requests'
      },
      {
        icon: "i-Add-User",
        title: '',
        subtitle: "العقارين",
        link: '/fund/providers'
      }
    ],
    topSellingProduct: [
      {
        title: "Wireless Headphone E23",
        description: "Lorem ipsum dolor sit amet consectetur.",
        prevPrice: 500,
        currentPrice: 450,
        imgUrl: "/assets/images/products/headphone-4.jpg"
      },
      {
        title: "Wireless Headphone Y902",
        description: "Lorem ipsum dolor sit amet consectetur.",
        prevPrice: 500,
        currentPrice: 200,
        imgUrl: "/assets/images/products/headphone-3.jpg"
      },
      {
        title: "Wireless Headphone E09",
        description: "Lorem ipsum dolor sit amet consectetur.",
        prevPrice: 500,
        currentPrice: 600,
        imgUrl: "/assets/images/products/headphone-2.jpg"
      },
      {
        title: "Wireless Headphone X89",
        description: "Lorem ipsum dolor sit amet consectetur.",
        prevPrice: 500,
        currentPrice: 350,
        imgUrl: "/assets/images/products/headphone-4.jpg"
      }
    ],
    newOffresList: [],
    userActivity: [
      {
        activitylist: [
          {
            title: "Pages / Visit",
            count: 2065
          },
          {
            title: "New user",
            count: 465
          },
          {
            title: "Last week",
            count: 23456
          }
        ]
      },
      {
        activitylist: [
          {
            title: "Pages / Visit",
            count: 435
          },
          {
            title: "New user",
            count: 5435643
          },
          {
            title: "Last week",
            count: 45435
          }
        ]
      },
      {
        activitylist: [
          {
            title: "Pages / Visit",
            count: 545
          },
          {
            title: "New user",
            count: 54353
          },
          {
            title: "Last week",
            count: 4643
          }
        ]
      }
    ],
    listPrams: {
      request_fund: '',
      form_date: '',
      to_date: '',
      time: ''
    },
    loading: false,
    places: {
      'الشرقية': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'الباحة': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'جازان': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'حائل': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'القصيم': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'الرياض': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'نجران': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'تبوك': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'المدينة المنورة': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'مكه المكرمة': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'عسير': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'الجوف': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
      'الحدود الشمالية': {
        'requests': 0,
        'offer': 0,
        'providers': 0
      },
    },
    offersArray: [],
    requestsArray: []
  };

  getUserStatusClass = status => {
    switch (status) {
      case "active":
        return "badge-success";
      case "inactive":
        return "badge-warning";
      case "pending":
        return "badge-primary";
      default:
        break;
    }
  };

  updatePageData = () => {
    this.setState({ loading: true });
    getDashYear('2021').then(res => {
      const data = res.data.data;
      // push data to array
      let offersList = [];
      let requestsList = [];
      offersList.push(data['January'].offers);
      offersList.push(data['February'].offers);
      offersList.push(data['March'].offers);
      offersList.push(data['April'].offers);
      offersList.push(data['May'].offers);
      offersList.push(data['June'].offers);
      offersList.push(data['July'].offers);
      offersList.push(data['August'].offers);
      offersList.push(data['September'].offers);
      offersList.push(data['October'].offers);
      offersList.push(data['November'].offers);
      offersList.push(data['December'].offers);

      requestsList.push(data['January'].requests);
      requestsList.push(data['February'].requests);
      requestsList.push(data['March'].requests);
      requestsList.push(data['April'].requests);
      requestsList.push(data['May'].requests);
      requestsList.push(data['June'].requests);
      requestsList.push(data['July'].requests);
      requestsList.push(data['August'].requests);
      requestsList.push(data['September'].requests);
      requestsList.push(data['October'].requests);
      requestsList.push(data['November'].requests);
      requestsList.push(data['December'].requests);
      
      this.setState({offersArray: offersList, requestsArray: requestsList});
    });

    getList().then(res => {
      let data = res.data.data;
      this.setState({
        // list: [...list],
        newOffresList: data.active_offer,
        cardList1: [
          {
            icon: "i-Checkout-Basket",
            title: data.all_offer,
            subtitle: "كل العروض المرسلة",
            link: '/offers'
          },
          {
            icon: "i-Financial",
            title: data.requests_dont_offer_count,
            subtitle: "طلبات دون عروض",
            link: '/requests'
          },
          {
            icon: "i-Money-2",
            title: data.requests_has_offer,
            subtitle: "طلبات لها عروض",
            link: '/requests'
          },
          {
            icon: "i-Add-User",
            title: data.providers,
            subtitle: "العقارين",
            link: '/fund/providers'
          },
        ],
        loading: false
      });
      getDashMap().then(res => {
        this.setState({ places: res.data.data });
      })
    });

  };

  componentDidMount() {
    // this.updatePageData();
  }

  render() {
    let {
      cardList1 = [],
      topSellingProduct = [],
      newOffresList = [],
      userActivity = [],
      loading,
      places,
      offersArray,
      requestsArray
    } = this.state;
    return (
      <div>
        <div className="alert alert-info p-5 h1 text-left" dir="rtl"> جاري العمل علي الصفحة!</div>
        {/* {loading
          ? <Loading></Loading>

          : <div className="page-content">
            <div className="row">
              {cardList1.map((card, index) => (
                <div key={index} className="col-lg-3 col-md-6 col-sm-6">
                  <div className="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div className="card-body text-center">
                      <i className={card.icon}></i>
                      <Link to={card.link} className="content">
                        <p className="text-muted mt-2 mb-0 text-capitalize">
                          {card.subtitle}
                        </p>
                        <p className="lead text-primary text-24 mb-2 text-capitalize">
                          {card.title}
                        </p>
                      </Link>
                    </div>
                  </div>
                </div>
              ))}
            </div>

            <div className="row">
              <div className="col-lg-6 col-md-6">
                <MapVector data={places}></MapVector>
                <br />
              </div>
              <div className="col-lg-6 col-md-12">

                <div className="card mb-4 places-table">
                  <div className="card-header card-title mb-0 d-flex align-items-center justify-content-between border-0">
                    <h3 className="float-left card-title m-0">
                      احصائيات حسب المناطق
                    </h3>
                  </div>

                  <div className="">
                    <div className="table-responsive">
                      <table id="user_table" className="table  text-center">
                        <thead>
                          <tr>
                            <th scope="col">المنطقة</th>
                            <th scope="col">الطلبات</th>
                            <th scope="col">العروض المرسلة</th>
                            <th scope="col">العقارين</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>الباحة</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الباحة'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الباحة'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الباحة'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>الجوف</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الجوف'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الجوف'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الجوف'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>الحدود الشمالية</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الحدود الشمالية'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الحدود الشمالية'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الحدود الشمالية'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>الرياض</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الرياض'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الرياض'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الرياض'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>الشرقية</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الشرقية'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الشرقية'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['الشرقية'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>القصيم</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['القصيم'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['القصيم'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['القصيم'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>المدينة المنورة</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['المدينة المنورة'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['المدينة المنورة'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['المدينة المنورة'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>تبوك</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['تبوك'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['تبوك'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['تبوك'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>جازان</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['جازان'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['جازان'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['جازان'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>حائل</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['حائل'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['حائل'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['حائل'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>عسير</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['عسير'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['عسير'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['عسير'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>مكه المكرمة</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['مكه المكرمة'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['مكه المكرمة'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['مكه المكرمة'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>
                          <tr>
                            <td>نجران</td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['نجران'].requests}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['نجران'].offer}
                                </button>
                              </OverlayTrigger>
                            </td>
                            <td>
                              <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض الكل</Tooltip>}>
                                <button
                                  type="button"
                                  className="btn btn-outline-primary btn-sm"
                                >
                                  {places['نجران'].providers}
                                </button>
                              </OverlayTrigger>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div className="row">


              <div className="col-lg-6 col-md-12">

                <div className="card mb-4">
                  <div className="card-header card-title mb-0 d-flex align-items-center justify-content-between border-0">
                    <h3 className="float-left card-title m-0">
                      آخر طلبات المعاينه
                    </h3>
                    <Link to="/requests">عرض الكل</Link>
                  </div>

                  <div className="">
                    <div className="table-responsive">
                      <table id="user_table" className="table  text-center">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">UUID</th>
                            <th scope="col">النوع</th>
                            <th scope="col">الحاله</th>
                            <th scope="col">العمليات</th>
                          </tr>
                        </thead>
                        <tbody>
                          {newOffresList.map((item, index) => (
                            <tr key={index}>
                              <th scope="row">{index + 1}</th>
                              <td>{item.uuid}</td>
                              <td>
                                <img
                                  className="p-1 m-0 avatar-sm-table "
                                  src={item.estate_type_icon}
                                  alt=""
                                />
                                <span>{item.estate_type_name_web}</span>
                              </td>

                              <td>
                                <span
                                  className={item.estate_status == 'جديد' ? 'badge badge-success' : 'badge badge-info'}
                                >
                                  {item.estate_status}
                                </span>
                              </td>
                              <td>
                                <Link to={`/request/${item.id}`} className="cursor-pointer text-light mr-2">
                                  <i className="nav-icon i-Eye font-weight-bold"></i>
                                </Link>
                              </td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>

              <div className="col-md-6">
                <SimpleCard title="احصائيات الطلبات والعروض المرسلة لهذا العام" className="mb-4">
                  <ComparisonChart height="260px" offersArray={offersArray} requestsArray={requestsArray}></ComparisonChart>
                </SimpleCard>
              </div>
            </div>
          </div>
        } */}
      </div>
    );
  }
}

export default BankDashboard;
