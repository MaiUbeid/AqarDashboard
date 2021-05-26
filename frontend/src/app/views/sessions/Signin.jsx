import React, { Component } from "react";
import { Formik, Form } from "formik";
import * as yup from "yup";
import { loginWithEmailAndPassword } from "app/redux/actions/LoginActions";
import PropTypes from "prop-types";
import { connect } from "react-redux";
import { Link } from "react-router-dom";
import { Button } from "react-bootstrap";
import FormikControl from "../common/FormikControl";
import userService from "../../services/userService";
import jwtAuthService from "../../services/jwtAuthService";
import { roles } from "app/services/role";
import history from "@history.js";

const SigninSchema = yup.object().shape({
  email: yup
    .string()
    .email("Invalid email")
    .required("email is required"),
  password: yup
    .string()
    .min(8, "Password must be 8 character long")
    .required("password is required")
});

class Signin extends Component {
  // state = {
  //   email: "watson@example.com",
  //   password: "12345678"
  // };

  // handleChange = event => {
  //   event.persist();
  //   this.setState({ [event.target.name]: event.target.value });
  // };

  // handleSubmit = (value, { isSubmitting }) => {
  //   this.props.loginWithEmailAndPassword(value);
  // };

  state = {
    username: "",
    password: "",
    type: "dashboard",
    // role: "Fund", // Static for dashboard.
    showLoadingSpinner: false,
  };
  componentDidMount() {
    document.title = "تسجيل الدخول";
  }
  handleSubmit = async (values, { setSubmitting }) => {
    try {
      this.setState({ ...values, showLoadingSpinner: true });
      jwtAuthService.loginWithEmailAndPassword(values.username, values.password, values.type);
      // var response = await userService.login({ username: values.username, password: values.password, type: values.type });
      // if (response.status === 200) {
      //   jwtAuthService.loginWithEmailAndPassword(values.username, values.password, values.type);
      // }
    } catch (ex) {
      this.setState({ showLoadingSpinner: false });
    }
  };

  render() {
    return (
      <div
        className="auth-layout-wrap"
        dir="rtl"
        style={{
          backgroundImage: "linear-gradient(0deg, rgb(195 148 243), rgb(245 245 245 / 30%)), url(/assets/images/photo-wide-4.jpg)"
        }}
      >
        <div className="auth-content">
          <div className="card o-hidden">
            <div className="row">
              <div className="col-md-12">
                <div className="p-4">
                  <div className="auth-logo text-center mb-4">
                    <img src="/assets/images/logo.png" alt="" />
                  </div>
                  <h1 className="mb-3 text-18">تسجيل الدخول</h1>
                  <Formik
                    initialValues={this.state}
                    validationSchema={validationSchema}
                    onSubmit={this.handleSubmit}
                    validateOnChange={false}
                    enableReinitialize
                  >
                    {(fromikProps) => {
                      return (
                        <Form className="needs-validation">
                          <div className="card-body">
                            <div className="form-row">
                              <FormikControl control="input" label="البريد الإلكتروني" name="username" placeholder="البريد الإلكتروني" />
                            </div>
                            <div className="form-row">
                              <FormikControl control="input" type="password" label="كلمة المرور" name="password" placeholder="أدخل كلمة المرور" />
                            </div>
                            <button className="btn btn-primary btn-block btn-rounded mt-3" type="submit">
                              {this.state.showLoadingSpinner && (
                                <React.Fragment>
                                  <span> جاري التحقق....</span>
                                  <span className="spinner-glow spinner-glow-light ml-2" style={{ verticalAlign: "middle" }}></span>
                                </React.Fragment>
                              )}
                              {!this.state.showLoadingSpinner && "تسجيل الدخول"}
                            </button>
                            <div className="mt-3 text-center">
                              {/* <Link to="/session/signup" className="text-muted">
                                <u>ليس لديك حساب؟ إنشاء حساب</u>
                              </Link> */}
                              {/* <div className="mt-3 text-center">
                                <Link to="/session/forgot-password" className="text-muted">
                                  <u>هل نسيت كلمة المرور؟</u>
                                </Link>
                              </div> */}
                            </div>
                          </div>
                        </Form>
                      );
                    }}
                  </Formik>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

const validationSchema = yup.object().shape({
  username: yup.string().email("البريد الإلكتروني غير صحيح.").required("هذا الحقل مطلوب"),
  password: yup.string().required("هذا الحقل مطلوب"),
});

// const mapStateToProps = state => ({
//   loginWithEmailAndPassword: PropTypes.func.isRequired,
//   user: state.user
// });

// export default connect(mapStateToProps, {
//   loginWithEmailAndPassword
// })(Signin);
export default Signin;

