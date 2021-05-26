import React from "react";
import { Field, ErrorMessage } from "formik";
import TextError from "./TextError";

export default function InputGroup(props) {
  const { label, name, hideIcon, onRemove, ...rest } = props;
  let { type, width } = props;
  if (!type) type = "text";
  if (!width) width = "12";
  return (
    <div className={`form-group`}>
      <div className="input-group">
        <label htmlFor={name}>{label}</label>
        <Field id={name} name={name} type={type} className="form-control" {...rest} />
        <div className="input-group-append">
        {hideIcon && (
          <button className="btn btn-danger" type="button" onClick={() => props.onRemove()}><i className="i-Close"></i>
          </button>
        )}
        </div>
        <ErrorMessage name={name} component={TextError} />
      </div>
    </div>
  );
}
