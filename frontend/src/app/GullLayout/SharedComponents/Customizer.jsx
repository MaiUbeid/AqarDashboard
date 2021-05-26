import React, { Component } from "react";
import PropTypes from "prop-types";
import { connect } from "react-redux";
import { merge } from "lodash";
import {
  setLayoutSettings,
  setDefaultSettings
} from "app/redux/actions/LayoutActions";
import { classList } from "@utils";
import ScrollBar from "react-perfect-scrollbar";

class Customizer extends Component {
  state = {};

  sidebarColors = [
    {
      name: "gradient-purple-indigo"
    },
    {
      name: "gradient-black-blue"
    },
    {
      name: "gradient-black-gray"
    },
    {
      name: "gradient-steel-gray"
    },
    {
      name: "dark-purple"
    },
    {
      name: "slate-gray"
    },
    {
      name: "midnight-blue"
    },
    {
      name: "blue"
    },
    {
      name: "indigo"
    },
    {
      name: "pink"
    },
    {
      name: "red"
    },
    {
      name: "purple"
    }
  ];

  handleLayoutChange = layoutName => {
    let { settings, setLayoutSettings } = this.props;
    setLayoutSettings(
      merge({}, settings, {
        activeLayout: layoutName
      })
    );
  };

  handleCustomizerToggle = () => {
    let { settings, setLayoutSettings } = this.props;
    setLayoutSettings(
      merge({}, settings, {
        customizer: {
          open: !settings.customizer.open
        }
      })
    );
  };
  handleDirectionChange = event => {
    let { settings, setLayoutSettings } = this.props;
    let dir = settings.dir === "rtl" ? "ltr" : "rtl";
    document.documentElement.setAttribute("dir", dir);
    setLayoutSettings(
      merge({}, settings, {
        dir: dir
      })
    );
  };
  changeSidebarColor = colorClass => {
    let { settings, setLayoutSettings } = this.props;
    setLayoutSettings(
      merge({}, settings, {
        layout2Settings: {
          leftSidebar: {
            theme: colorClass
          }
        }
      })
    );
  };

  render() {
    let { settings } = this.props;
    let { activeLayout } = settings;

    return (
      <div
        id="customizer"
        className={classList({
          customizer: true,
          open: settings.customizer.open
        })}
      >
        <div className="handle" onClick={this.handleCustomizerToggle}>
          <i className="i-Gear spin"></i>
        </div>
        <ScrollBar
          className="customizer-body"
          data-perfect-scrollbar
          data-suppress-scroll-x="true"
        >
          <div className="accordion" id="accordionCustomizer">
            <div className="card">
              <div className="card-header" id="headingOne">
                <p className="mb-0">Sidebar Layout</p>
              </div>

              <div
                id="collapseOne"
                className="collapse show"
                aria-labelledby="headingThree"
                data-parent="#accordionCustomizer"
              >
                <div className="card-body layouts">
                  <div
                    className={classList({
                      "layout-box": true,
                      active: activeLayout === "layout1"
                    })}
                    onClick={() => this.handleLayoutChange("layout1")}
                  >
                    <img
                      src="/assets/images/screenshots/04_preview.png"
                      alt=""
                    />
                    <i className="i-Eye"> </i>
                  </div>
                  <div
                    className={classList({
                      "layout-box": true,
                      active: activeLayout === "layout2"
                    })}
                    onClick={() => this.handleLayoutChange("layout2")}
                  >
                    <img
                      src="/assets/images/screenshots/02_preview.png"
                      alt=""
                    />
                    <i className="i-Eye"> </i>
                  </div>
                </div>
              </div>
            </div>
            {settings.activeLayout === "layout2" && (
              <div className="card">
                <div className="card-header" id="headingOne">
                  <p className="mb-0">Sidebar Colors</p>
                </div>

                <div
                  id="collapseOne"
                  className="collapse show"
                  aria-labelledby="headingOne"
                  data-parent="#accordionCustomizer"
                >
                  <div className="card-body">
                    <div className="colors sidebar-colors">
                      {this.sidebarColors.map((c, i) => (
                        <span
                          className={`color ${c.name}`}
                          title={c.name}
                          onClick={() =>
                            this.changeSidebarColor(`sidebar-${c.name}`)
                          }
                          key={i}
                        >
                          <i className="i-Eye"></i>
                        </span>
                      ))}
                    </div>
                  </div>
                </div>
              </div>
            )}

            <div className="card">
              <div className="card-header" id="headingOne">
                <p className="mb-0">RTL</p>
              </div>

              <div
                id="collapseTwo"
                className="collapse show"
                aria-labelledby="headingTwo"
                data-parent="#accordionCustomizer"
              >
                <div className="card-body">
                  <label className="checkbox checkbox-primary">
                    <input
                      type="checkbox"
                      id="rtl-checkbox"
                      checked={settings.dir === "rtl" ? true : false}
                      onChange={this.handleDirectionChange}
                    />
                    <span>Enable RTL</span>
                    <span className="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>

            {/* <div className="card">
              <div className="card-header" id="headingThree">
                <p className="mb-0">Bootstrap Colors</p>
              </div>

              <div
                id="collapseThree"
                className="collapse show"
                aria-labelledby="headingThree"
                data-parent="#accordionCustomizer"
              >
                <div className="card-body">
                  <div className="bootstrap-colors colors">
                    <span title="lite-purple" className="color purple"></span>
                    <span title="lite-blue" className="color blue"></span>
                  </div>
                </div>
              </div>
            </div> */}
          </div>
        </ScrollBar>
      </div>
    );
  }
}

Customizer.propTypes = {
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
})(Customizer);
