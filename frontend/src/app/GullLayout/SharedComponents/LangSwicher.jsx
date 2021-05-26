import React, { Component, useEffect, useState } from "react";
import PropTypes from "prop-types";
import { connect } from "react-redux";
import { merge } from "lodash";
import {
  setLayoutSettings,
  setDefaultSettings
} from "app/redux/actions/LayoutActions";
import { classList } from "@utils";
import localStorageService from "./../../services/localStorageService";
import { useTranslation, withTranslation, Trans } from 'react-i18next';
import { navigationsAr, navigationsEn } from "../../navigations";


// use hoc for class based components
class LegacyWelcomeClass extends Component {
  render() {
    const { t } = this.props;
    return <h2>{t('inputs.name')}</h2>;
  }
}


const Welcome = withTranslation()(LegacyWelcomeClass);

function Page() {
  const { t, i18n } = useTranslation();
  let dir = 'rtl';
  const lng = localStorageService.getLang();
  const changeLanguage = (lng) => {
    window.location.reload();
    i18n.changeLanguage(lng);
    localStorageService.setItem("aqarz_lang", lng);
    localStorageService.getLang();
    dir = (lng === "en") ? "ltr" : "rtl";

    document.documentElement.setAttribute("lang", lng);
    document.documentElement.setAttribute("dir", dir);
  };
  return (
    <div className="lang-swicher">
      <div
        className={classList({
          "lang": true,
          'd-none': lng === "ar"
        })}
        onClick={() => changeLanguage('ar')}
      >
        <img
          src="/assets/images/sa.svg"
          alt=""
        />
      </div>
      <div
        className={classList({
          "lang": true,
          'd-none': !lng || lng === "en"
        })}
        onClick={() => changeLanguage('en')}
      >
        <img
          src="/assets/images/us.svg"
          alt=""
        />

      </div>
    </div>
  );
}

class LangSwicher extends Component {
  state = {};
  handleNavigatorsChange = event => {
    let { settings, setLayoutSettings } = this.props;

    // setLayoutSettings(
    //   merge({}, settings, {
    //     navigationList: []
    //   })
    // );
  };
  render() {
    return (
      <div onClick={this.handleNavigatorsChange}>
        <Page />
      </div>
    );
  }
}



LangSwicher.propTypes = {
  setLayoutSettings: PropTypes.func.isRequired,
  setDefaultSettings: PropTypes.func.isRequired,
  settings: PropTypes.object.isRequired
};

const mapStateToProps = state => ({
  setLayoutSettings: PropTypes.func.isRequired,
  setDefaultSettings: PropTypes.func.isRequired,
  settings: state.layout.settings
});

export default connect(mapStateToProps, {
  setLayoutSettings,
  setDefaultSettings
})(LangSwicher);
