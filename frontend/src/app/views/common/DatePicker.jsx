import React from "react";
import DateView from "react-datepicker";
import { Field, ErrorMessage } from "formik";
import TextError from "./TextError";
import "react-datepicker/dist/react-datepicker.css";

function DatePicker(props) {
  const { label, name, ...rest } = props;
  let { width, format } = props;
  if (!width) width = "4";
  if (!format) format = "dd-MMM-yyyy";
  return (
    <div className={`form-group col-md-${width}`}>
      <label htmlFor={name}>{label}</label>
        <Field name={name} className="form-control">
          {({ form, field }) => {
            const { setFieldValue } = form;
            const { value } = field;
            return <DateView dateFormat={format} autoComplete="off" id={name} {...field} {...rest} selected={value} onChange={(val) => setFieldValue(name, val)} className="form-control" />;
          }}
        </Field>
      
      <ErrorMessage component={TextError} name={name} />
    </div>
  );
}

export default DatePicker;
