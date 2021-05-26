import React, { Fragment } from "react";

const Footer = () => {
  return (
    <Fragment>
      <div className="flex-grow-1"></div>
      <div className="app-footer">

        <div className="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">

          <span className="flex-grow-1"></span>
          <div className="">
            <img className="logo float-right" src="/assets/images/logo.png" alt="" />
            <div className="float-right mt-2">
              <p className="m-0">&copy; 2021 Aqarz</p>
              <p className="m-0">All rights reserved</p>
            </div>
          </div>
        </div>
      </div>
    </Fragment>
  );
};

export default Footer;
