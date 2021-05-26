import React, { Component } from "react";
import ComparisonChart from "app/views/charts/echarts/ComparisonChart";
import PieChart from "app/views/charts/echarts/PieChart";
import LineChart3 from "app/views/charts/echarts/LineChart3";
import LineChart1 from "app/views/charts/echarts/LineChart1";
import LineChart2 from "app/views/charts/echarts/LineChart2";
import { Breadcrumb } from "@gull";
import SimpleCard from "@gull/components/cards/SimpleCard";
import { Dropdown } from "react-bootstrap";
import { Link } from "react-router-dom";
import { useTranslation, withTranslation, Trans } from 'react-i18next';

class Dashboard1 extends Component {
  state = {
    cardList1: [
      {
        icon: "i-Add-User",
        title: "205",
        subtitle: "new leads"
      },
      {
        icon: "i-Financial",
        title: "4021",
        subtitle: "sales"
      },
      {
        icon: "i-Checkout-Basket",
        title: "80",
        subtitle: "checkout"
      },
      {
        icon: "i-Money-2",
        title: "120",
        subtitle: "expense"
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
    newUserList: [
      {
        name: "Smith Doe",
        email: "Smith@gmail.com",
        status: "active",
        photoUrl: "/assets/images/faces/1.jpg"
      },
      {
        name: "Jhon Doe",
        email: "Jhon@gmail.com",
        status: "pending",
        photoUrl: "/assets/images/faces/2.jpg"
      },
      {
        name: "Alex",
        email: "Otttio@gmail.com",
        status: "inactive",
        photoUrl: "/assets/images/faces/3.jpg"
      },
      {
        name: "Mathew Doe",
        email: "matheo@gmail.com",
        status: "active",
        photoUrl: "/assets/images/faces/4.jpg"
      }
    ],
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
    ]
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

  render() {
    let {
      cardList1 = [],
      topSellingProduct = [],
      newUserList = [],
      userActivity = []
    } = this.state;
    return (
      <div>
        {/* <Trans i18nKey="inputs.name"></Trans> */}
        <div className="row">
          {cardList1.map((card, index) => (
            <div key={index} className="col-lg-3 col-md-6 col-sm-6">
              <div className="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div className="card-body text-center">
                  <i className={card.icon}></i>
                  <div className="content">
                    <p className="text-muted mt-2 mb-0 text-capitalize">
                      {card.subtitle}
                    </p>
                    <p className="lead text-primary text-24 mb-2 text-capitalize">
                      {card.title}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>

        <div className="row">
          <div className="col-lg-8 col-md-12">
            <SimpleCard title="This Year Sales" className="mb-4">
              <ComparisonChart height="260px"></ComparisonChart>
            </SimpleCard>
          </div>
          <div className="col-lg-4 col-sm-12">
            <SimpleCard title="Sales by Countries" className="mb-4">
              <PieChart height="260px"></PieChart>
            </SimpleCard>
          </div>
        </div>

        <div className="row">
          <div className="col-lg-6 col-md-12">
            <div className="row">
              <div className="col-lg-6 col-md-12">
                <div className="card mb-4">
                  <div className="card-title card-body mb-0 pb-0">
                    <h3 className="mb-4">Last Month Sales</h3>
                    <p className="text-primary mb-0 text-24">$40250</p>
                  </div>
                  <LineChart1 height="260px"></LineChart1>
                </div>
              </div>

              <div className="col-lg-6 col-md-12">
                <div className="card mb-4">
                  <div className="card-title card-body mb-0 pb-0">
                    <h3 className="mb-4">Last Week Sales</h3>
                    <p className="text-primary mb-0 text-24">$10250</p>
                  </div>
                  <LineChart2 height="260px"></LineChart2>
                </div>
              </div>
            </div>

            <div className="row">
              <div className="col-md-12">
                <div className="card mb-4">
                  <div className="card-header card-title mb-0 d-flex align-items-center justify-content-between border-0">
                    <h3 className="w-50 float-left card-title m-0">
                      New Users
                    </h3>
                    <Dropdown alignRight>
                      <Dropdown.Toggle
                        as="span"
                        className="toggle-hidden cursor-pointer"
                      >
                        <i className="nav-icon i-Gear-2"></i>
                      </Dropdown.Toggle>
                      <Dropdown.Menu>
                        <Dropdown.Item>Add new user</Dropdown.Item>
                        <Dropdown.Item>View All users</Dropdown.Item>
                        <Dropdown.Item>Something else here</Dropdown.Item>
                      </Dropdown.Menu>
                    </Dropdown>
                  </div>

                  <div className="">
                    <div className="table-responsive">
                      <table id="user_table" className="table  text-center">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {newUserList.map((user, index) => (
                            <tr key={index}>
                              <th scope="row">{index + 1}</th>
                              <td>{user.name}</td>
                              <td>
                                <img
                                  className="rounded-circle m-0 avatar-sm-table "
                                  src={user.photoUrl}
                                  alt=""
                                />
                              </td>

                              <td>{user.email}</td>
                              <td>
                                <span
                                  className={`badge ${this.getUserStatusClass(
                                    user.status
                                  )}`}
                                >
                                  {user.status}
                                </span>
                              </td>
                              <td>
                                <span className="cursor-pointer text-success mr-2">
                                  <i className="nav-icon i-Pen-2 font-weight-bold"></i>
                                </span>
                                <span className="cursor-pointer text-danger mr-2">
                                  <i className="nav-icon i-Close-Window font-weight-bold"></i>
                                </span>
                              </td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div className="col-lg-6 col-md-12">

            <div className="card mb-4">
              <div className="card-body p-0">
                <div className="card-title border-bottom d-flex align-items-center m-0 p-3">
                  <h3 className="mb-0">User activity</h3>
                  <span className="flex-grow-1"></span>
                  <span className="badge badge-pill badge-warning">
                    Updated daily
                  </span>
                </div>
                {userActivity.map(({ activitylist = [] }, index) => (
                  <div
                    key={index}
                    className="d-flex border-bottom justify-content-between p-3"
                  >
                    {activitylist.map((item, i) => (
                      <div key={i} className="flex-grow-1">
                        <span className="text-small text-muted">
                          {item.title}
                        </span>
                        <h5 className="m-0">{item.count}</h5>
                      </div>
                    ))}
                  </div>
                ))}
              </div>
            </div>
          </div>

          <div className="col-md-12">
            <div className="card mb-4">
              <div className="card-body card-title mb-0">
                <h3 className="m-0">Last 20 Day Leads</h3>
              </div>
              <LineChart3 height="360px"></LineChart3>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default Dashboard1;
