import React, { Component, Suspense } from "react";
import AppContext from "app/appContext";
import { renderRoutes } from "react-router-config";

import Layout1Sidenav from "./Layout1Sidenav";
import Footer from "../SharedComponents/Footer";
import Layout1Header from "./Layout1Header";

import { connect } from "react-redux";
import PropTypes from "prop-types";
import { classList } from "@utils";
import GullSearch from "@gull/components/GullSearch";
import { setLayoutSettings } from "app/redux/actions/LayoutActions";
import { merge } from "lodash";
import Loading from "@gull/components/GullLoadable/Loading";

class Layout1 extends Component {
  state = {};

  handleSearchBoxClose = () => {
    let { setLayoutSettings, settings } = this.props;
    setLayoutSettings(
      merge({}, settings, {
        layout1Settings: {
          searchBox: {
            open: false
          }
        }
      })
    );
  };

  render() {
    let { settings, routes } = this.props;

    return (
      <div>
        <div className={`app-admin-wrap layout-sidebar-large`}>
          <Layout1Header></Layout1Header>
          <Layout1Sidenav />
          {/* sidebar */}

          <div
            className={classList({
              "main-content-wrap d-flex flex-column": true,
              "sidenav-open": settings.layout1Settings.leftSidebar.open
            })}
          >
            <Suspense fallback={<Loading />}>
              <div className="main-content">{renderRoutes(routes)}</div>
            </Suspense>
            {(settings.footer.show && <Footer></Footer>)}
          </div>
        </div>
        <GullSearch
          open={settings.layout1Settings.searchBox.open}
          handleClose={this.handleSearchBoxClose}
        ></GullSearch>
      </div>
    );
  }
}

const mapStateToProps = state => ({
  setLayoutSettings: PropTypes.func.isRequired,
  settings: state.layout.settings
});

export default connect(mapStateToProps, { setLayoutSettings })(Layout1);
