import React from "react";
import { Field, ErrorMessage } from "formik";
import TextError from "./TextError";

function SwitchButton(props) {
  let { label, name, value, width, checked, ...rest } = props;
  if (!width) width = "4";
  return (
    <div className={`card-body col-md-${width} form-group mb-3`}>
      <label className="switch pr-5 switch-primary mr-3">
        <span>{label}</span>
        <Field name={name}>
          {({ field }) => {
            return (
              <React.Fragment>
                <input type="checkbox" id={name} {...field} {...rest} value={value} checked={checked} />
              </React.Fragment>
            );
          }}
        </Field>{" "}
        <span className="slider"></span>{" "}
      </label>
      <ErrorMessage component={TextError} name={name} />
    </div>
  );
}

export default SwitchButton;
