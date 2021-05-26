import React from "react";
import { Field, ErrorMessage } from "formik";
import TextError from "./TextError";

export default function Input(props) {
  const { label, name, ...rest } = props;
  let { type, width } = props;
  if (!type) type = "text";
  if (!width) width = "12";
  return (
    <div className={`form-group col-md-${width}`}>
      <label htmlFor={name}>{label}</label>
      <Field id={name} name={name} type={type} className="form-control" {...rest} />
      <ErrorMessage name={name} component={TextError} />
    </div>
  );
}
