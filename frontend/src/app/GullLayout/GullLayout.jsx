import React, { Component, Suspense } from "react";
import { connect } from "react-redux";
import { PropTypes } from "prop-types";
import { withRouter } from "react-router-dom";
import AppContext from "app/appContext";
import {
  setLayoutSettings,
  setDefaultSettings
} from "app/redux/actions/LayoutActions";

import { GullLayouts } from ".";
import Customizer from "./SharedComponents/Customizer";

class GullLayout extends Component {
  state = {};

  // constructor(props, context) {
  //   super(props);
  //   this.appContext = context;
  //   this.updateSettingsFromRouter();

  //   // Set settings from query (Only for demo purpose)
  //   this.setLayoutFromQuery();
  // }

  componentDidUpdate(prevProps) {
    if (this.props.location.pathname !== prevProps.location.pathname) {
      // initCodeViewer();
      // this.updateSettingsFromRouter();
    }
  }
  componentDidMount() {
    this.initAppDirection();
  }

  // updateSettingsFromRouter() {
  //   const { routes } = this.appContext;
  //   const matched = matchRoutes(routes, this.props.location.pathname)[0];
  //   let { defaultSettings, settings, setLayoutSettings } = this.props;

  //   if (matched && matched.route.settings) {
  //     // ROUTE HAS SETTINGS
  //     console.log(matched.route.settings);

  //     const updatedSettings = merge({}, settings, matched.route.settings);
  //     if (!isEqual(settings, updatedSettings)) {
  //       setLayoutSettings(updatedSettings);
  //       // console.log('Route has settings');
  //     }
  //   } else if (!isEqual(settings, defaultSettings)) {
  //     console.log("routes not found");

  //     setLayoutSettings(defaultSettings);
  //     // console.log('reset settings', defaultSettings);
  //   }
  // }

  // setLayoutFromQuery = () => {
  //   try {
  //     let settingsFromQuery = getQueryParam("settings");
  //     settingsFromQuery = settingsFromQuery
  //       ? JSON.parse(settingsFromQuery)
  //       : {};
  //     let { settings, setLayoutSettings, setDefaultSettings } = this.props;
  //     let updatedSettings = merge({}, settings, settingsFromQuery);

  //     setLayoutSettings(updatedSettings);
  //     setDefaultSettings(updatedSettings);
  //   } catch (e) {
  //     // console.log("Error! Set settings from query param", e);
  //   }
  // };

  initAppDirection = () => {
    let { settings } = this.props;
    setTimeout(() => {
      document.documentElement.setAttribute('dir', settings.dir);
    });
  }

  render() {
    let { activeLayout, route, settings } = this.props;
    let Layout = GullLayouts[activeLayout];
    return (
      <Suspense>
        <Layout routes={route.routes}></Layout>
        {(settings.customizer.show && <Customizer></Customizer>)}
      </Suspense>
    );
  }
}

const mapStateToProps = state => ({
  setLayoutSettings: PropTypes.func.isRequired,
  setDefaultSettings: PropTypes.func.isRequired,
  settings: state.layout.settings,
  activeLayout: state.layout.settings.activeLayout,
  defaultSettings: state.layout.defaultSettings
});

GullLayout.contextType = AppContext;

export default withRouter(
  connect(mapStateToProps, { setLayoutSettings, setDefaultSettings })(
    GullLayout
  )
);
