import React from "react";
import { Field, ErrorMessage } from "formik";
import TextError from "./TextError";

function Select(props) {
  let { label, name, options, addDefaultItem, width, ...rest } = props;
  if (!width) {
    width = "6";
  }
  return (
    <div className={`form-group col-md-${width}`}>
      <label htmlFor={name}>{label}</label>
      <Field as="select" id={name} name={name} {...rest} className="form-control">
        {options.map((option) => {
          return (
            <option key={option.value} value={option.value}>
              {option.text}
            </option>
          );
        })}
      </Field>
      <ErrorMessage name={name} component={TextError} />
    </div>
  );
}

export default Select;
