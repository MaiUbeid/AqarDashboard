import React, { Component } from "react";
import { Dropdown } from "react-bootstrap";
import DropdownMenu from "react-bootstrap/DropdownMenu";
import { getTimeDifference } from "@utils";
import DropdownToggle from "react-bootstrap/DropdownToggle";
import { Link } from "react-router-dom";

import PropTypes from "prop-types";
import { connect } from "react-redux";
import {
  setLayoutSettings,
  setDefaultSettings
} from "app/redux/actions/LayoutActions";
import { logoutUser } from "app/redux/actions/UserActions";
import { withRouter } from "react-router-dom";

import { merge } from "lodash";
import MegaMenu from "@gull/components/MegaMenu";
import LangSwicher from "../SharedComponents/LangSwicher";

class Layout1Header extends Component {
  state = {
    shorcutMenuList: [
      {
        icon: "i-Shop-4",
        link: "#",
        text: "Home"
      },
      {
        icon: "i-Library",
        link: "#",
        text: "Ui Kits"
      },
      {
        icon: "i-Drop",
        link: "#",
        text: "Apps"
      },
      {
        icon: "i-File-Clipboard-File--Text",
        link: "#",
        text: "Form"
      },
      {
        icon: "i-Checked-User",
        link: "#",
        text: "Sessions"
      },
      {
        icon: "i-Ambulance",
        link: "#",
        text: "Support"
      }
    ],
    notificationList: [
      {
        icon: "i-Speach-Bubble-6",
        title: "New message",
        description: "James: Hey! are you busy?",
        time: "2019-10-30T02:10:18.931Z",
        color: "primary",
        status: "New"
      },
      {
        icon: "i-Receipt-3",
        title: "New order received",
        description: "1 Headphone, 3 iPhone",
        time: "2019-03-10T02:10:18.931Z",
        color: "success",
        status: "New"
      },
      {
        icon: "i-Empty-Box",
        title: "Product out of stock",
        description: "1 Headphone, 3 iPhone",
        time: "2019-05-10T02:10:18.931Z",
        color: "danger",
        status: "3"
      },
      {
        icon: "i-Data-Power",
        title: "Server up!",
        description: "Server rebooted successfully",
        time: "2019-03-10T02:10:18.931Z",
        color: "success",
        status: "3"
      }
    ],
    showSearchBox: false
  };

  handleMenuClick = () => {
    let { setLayoutSettings, settings } = this.props;
    setLayoutSettings(
      merge({}, settings, {
        layout1Settings: {
          leftSidebar: {
            open: settings.layout1Settings.leftSidebar.secondaryNavOpen
              ? true
              : !settings.layout1Settings.leftSidebar.open,
            secondaryNavOpen: false
          }
        }
      })
    );
  };

  toggleFullScreen = () => {
    if (document.fullscreenEnabled) {
      if (!document.fullscreen) document.documentElement.requestFullscreen();
      else document.exitFullscreen();
    }
  };

  handleSearchBoxOpen = () => {
    let { setLayoutSettings, settings } = this.props;
    setLayoutSettings(
      merge({}, settings, {
        layout1Settings: {
          searchBox: {
            open: true
          }
        }
      })
    );
  };

  render() {
    let { shorcutMenuList = [], notificationList = [] } = this.state;

    return (
      <div className="main-header">
        <div className="logo">
          <img src="/assets/images/logo.png" alt="" />
        </div>

        <div className="menu-toggle" onClick={this.handleMenuClick}>
          <div></div>
          <div></div>
          <div></div>
        </div>
        {/* <LangSwicher></LangSwicher> */}

        {/* <div className="d-none d-lg-flex align-items-center">
          <Dropdown className="mr-3">
            <Dropdown.Toggle as="span" className="toggle-hidden cursor-pointer">
              Mega Menu
            </Dropdown.Toggle>

            <div className="mega-menu">
              <Dropdown.Menu>
                <MegaMenu></MegaMenu>
              </Dropdown.Menu>
            </div>
          </Dropdown>

          <div className="search-bar">
            <input
              type="text"
              placeholder="Search"
              onFocus={this.handleSearchBoxOpen}
            />
            <i className="search-icon text-muted i-Magnifi-Glass1"></i>
          </div>
        </div> */}

        <div style={{ margin: "auto" }}></div>

        <div className="header-part-right">
          <i
            className="i-Full-Screen header-icon d-none d-sm-inline-block"
            data-fullscreen
            onClick={this.toggleFullScreen}
          ></i>

          {/* <Dropdown>
            <Dropdown.Toggle as="span" className="toggle-hidden">
              <i
                className="i-Safe-Box text-muted header-icon"
                role="button"
              ></i>
            </Dropdown.Toggle>
            <Dropdown.Menu>
              <div className="menu-icon-grid">
                {shorcutMenuList.map(menu => (
                  <Link key={menu.text} to={menu.link}>
                    <i className={menu.icon}></i> {menu.text}
                  </Link>
                ))}
              </div>
            </Dropdown.Menu>
          </Dropdown> */}

          <Dropdown>
            {/* <Dropdown.Toggle as="span" className="toggle-hidden cursor-pointer">
              <div
                className="badge-top-container"
                role="button"
                id="dropdownNotification"
                data-toggle="dropdown"
              >
                <span className="badge badge-primary">3</span>
                <i className="i-Bell text-muted header-icon"></i>
              </div>
            </Dropdown.Toggle> */}

            {/* <DropdownMenu className="notification-dropdown rtl-ps-none">
              {notificationList.map((note, index) => (
                <div key={index} className="dropdown-item d-flex">
                  <div className="notification-icon">
                    <i className={`${note.icon} text-${note.color} mr-1`}></i>
                  </div>
                  <div className="notification-details flex-grow-1">
                    <p className="m-0 d-flex align-items-center">
                      <span>{note.title}</span>
                      <span
                        className={`badge badge-pill badge-${note.color} ml-1 mr-1`}
                      >
                        {note.status}
                      </span>
                      <span className="flex-grow-1"></span>
                      <span className="text-small text-muted ml-auto">
                        {getTimeDifference(new Date(note.time))} ago
                      </span>
                    </p>
                    <p className="text-small text-muted m-0">
                      {note.description}
                    </p>
                  </div>
                </div>
              ))}
            </DropdownMenu> */}
          </Dropdown>

          <div className="user col align-self-end">
            <Dropdown>
              <DropdownToggle
                as="span"
                className="toggle-hidden cursor-pointer"
              >
                <img
                  src="/assets/images/default-profile-icon.jpg"
                  id="userDropdown"
                  alt=""
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                />
              </DropdownToggle>
              <DropdownMenu>
                <div className="dropdown-header">
                  <i className="i-Lock-User mr-1"></i> {this.props.user.name}
                </div>
                <Link to="/" className="dropdown-item cursor-pointer">
                  Account settings
                </Link>
                <Link
                  to="/"
                  className="dropdown-item cursor-pointer"
                  onClick={this.props.logoutUser}
                >
                  Sign out
                </Link>
              </DropdownMenu>
            </Dropdown>
          </div>
        </div>
      </div>
    );
  }
}

Layout1Header.propTypes = {
  setLayoutSettings: PropTypes.func.isRequired,
  setDefaultSettings: PropTypes.func.isRequired,
  logoutUser: PropTypes.func.isRequired,
  user: PropTypes.object.isRequired,
  settings: PropTypes.object.isRequired
};

const mapStateToProps = state => ({
  setDefaultSettings: PropTypes.func.isRequired,
  setLayoutSettings: PropTypes.func.isRequired,
  logoutUser: PropTypes.func.isRequired,
  user: state.user,
  settings: state.layout.settings
});

export default withRouter(
  connect(mapStateToProps, {
    setLayoutSettings,
    setDefaultSettings,
    logoutUser
  })(Layout1Header)
);
