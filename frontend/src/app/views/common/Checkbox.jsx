import React from "react";
import { Field, ErrorMessage } from "formik";
import TextError from "./TextError";

function Checkbox(props) {
  let { label, name, value, width, ...rest } = props;
  if (!width) width = "4";
  return (
    <div className={`card-body col-md-${width} form-group mb-3`}>
      <label className="checkbox checkbox-outline-primary">
        <span>{label}</span>
        <Field name={name}>
          {({ field }) => {
            return (
              <React.Fragment>
                <input type="checkbox" id={name} {...field} {...rest} value={value} checked={field.value} />
              </React.Fragment>
            );
          }}
        </Field>
        <span className="checkmark"></span>
      </label>
      <ErrorMessage component={TextError} name={name} />
    </div>
  );
}

export default Checkbox;
