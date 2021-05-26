import React, { Component } from "react";
import { NavLink } from "react-router-dom";
import { publishNavigationChange } from "../../navigations";
import { merge } from "lodash";
import { classList, isMobile } from "@utils";
import Srcollbar from "react-perfect-scrollbar";
import { DropDownMenu } from "@gull";

import PropTypes from "prop-types";
import { connect } from "react-redux";
import {
  setLayoutSettings,
  setDefaultSettings
} from "app/redux/actions/LayoutActions";
import { logoutUser } from "app/redux/actions/UserActions";
import { withRouter } from "react-router-dom";
import ScrollBar from "react-perfect-scrollbar";
import { getMeanSideBar, getMeanSideBarUser } from '../../services/MeanSideBar'

class Layout1Sidenav extends Component {
  windowListener = null;

  state = {
    selectedItem: null,
    navOpen: true,
    secondaryNavOpen: false,
    navigationsList: [],
    requestNav: [],
    providerNav: []
  };

  onMainItemMouseEnter = item => {
    if (item.type === "dropDown") {
      this.setSelected(item);
      this.openSecSidenav();
    } else {
      this.setSelected(item);
      this.closeSecSidenav();
    }
  };


  onMainItemMouseLeave = () => {
    // this.closeSecSidenav();
  };

  setSelected = selectedItem => {
    this.setState({ selectedItem });
    // console.log(selectedItem);
  };

  removeSelected = () => {
    this.setState({ selectedItem: null });
    // console.log('removed');
  };

  openSecSidenav = () => {
    let { setLayoutSettings, settings } = this.props;

    setLayoutSettings(
      merge({}, settings, {
        layout1Settings: {
          leftSidebar: {
            secondaryNavOpen: true
          }
        }
      })
    );
  };

  closeSecSidenav = () => {
    // console.log("closing sec sidenav");
    let { setLayoutSettings, settings } = this.props;
    let other = {};

    if (isMobile()) {
      other.open = false;
    }

    setLayoutSettings(
      merge({}, settings, {
        layout1Settings: {
          leftSidebar: {
            ...other,
            secondaryNavOpen: false
          }
        }
      })
    );
  };

  closeSidenav = () => {
    // console.log("closing sidenav");

    let { setLayoutSettings, settings } = this.props;
    setLayoutSettings(
      merge({}, settings, {
        layout1Settings: {
          leftSidebar: {
            open: false,
            secondaryNavOpen: false
          }
        }
      })
    );
  };

  openSidenav = () => {
    // console.log("opening sidenav");
    let { setLayoutSettings, settings } = this.props;
    setLayoutSettings(
      merge({}, settings, {
        layout1Settings: {
          leftSidebar: {
            open: true
          }
        }
      })
    );
  };


  async componentDidMount() {
    if (this.state.selectedItem === null) this.closeSecSidenav();
    // this.setState({ navigationsList: publishNavigationChange(this.props.user.type, 'ar') });
    let { setLayoutSettings, settings } = this.props;
    const requestBar = await getMeanSideBar();
    const providersBar = await getMeanSideBarUser();
    this.setState({ requestNav: await requestBar.data.data, providerNav: await providersBar.data.data });
    // publishNavigationChange(this.props.user.role, 'ar')[1].sub = this.state.requestNav;
    // console.log('iiii', publishNavigationChange(this.props.user.role, 'ar'))
    setLayoutSettings(
      merge({}, settings, {
        navigationList: publishNavigationChange(this.props.user.role, 'ar')
      })
    );


    if (window)
      if (window.innerWidth < 1200) {
        this.closeSidenav();
      } else {
        this.openSidenav();
      }

    this.windowListener = window.addEventListener("resize", ({ target }) => {
      if (window.innerWidth < 1200) {
        this.closeSidenav();
      } else {
        this.openSidenav();
      }
    });

  }

  componentWillUnmount() {

    if (this.windowListener) {
      window.removeEventListener("resize", this.windowListener);
    }
  }


  render() {
    let { settings } = this.props;
    return (
      <div className="side-content-wrap">
        <Srcollbar
          className={classList({
            "sidebar-left o-hidden rtl-ps-none": true,
            open: settings.layout1Settings.leftSidebar.open
          })}
        // id="mainsidenav"
        >
          <ul className="navigation-left">
            {settings.navigationList.map((item, i) => (
              <li
                className={classList({
                  "nav-item": true,
                  active: this.state.selectedItem === item
                })}
                onMouseEnter={() => {
                  this.onMainItemMouseEnter(item);
                }}
                onMouseLeave={this.onMainItemMouseLeave}
                key={i}
              >
                {item.path && item.type !== "extLink" && (
                  <NavLink className="nav-item-hold" to={item.path}>
                    <i className={`nav-icon ${item.icon}`}></i>
                    <span className="nav-text">{item.name}</span>
                  </NavLink>
                )}
                {item.path && item.type === "extLink" && (
                  <a className="nav-item-hold" href={item.path}>
                    <i className={`nav-icon ${item.icon}`}></i>
                    <span className="nav-text">{item.name}</span>
                  </a>
                )}
                {!item.path && (
                  <div className="nav-item-hold">
                    <i className={`nav-icon ${item.icon}`}></i>
                    <span className="nav-text">{item.name}</span>
                  </div>
                )}
                <div className="triangle"></div>
              </li>
            ))}
          </ul>

        </Srcollbar>

        <ScrollBar
          className={classList({
            "sidebar-left-secondary o-hidden rtl-ps-none": true,
            open: settings.layout1Settings.leftSidebar.secondaryNavOpen
          })}
        >
          {this.state.selectedItem && this.state.selectedItem.sub && (
            <DropDownMenu
              menu={this.state.selectedItem.sub}
              closeSecSidenav={this.closeSecSidenav}
            ></DropDownMenu>
          )}
          <span></span>
        </ScrollBar>
        <div
          onMouseEnter={this.closeSecSidenav}
          className={classList({
            "sidebar-overlay": true,
            open: settings.layout1Settings.leftSidebar.secondaryNavOpen
          })}
        ></div>
      </div>
    );
  }
}

Layout1Sidenav.propTypes = {
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
  })(Layout1Sidenav)
);
