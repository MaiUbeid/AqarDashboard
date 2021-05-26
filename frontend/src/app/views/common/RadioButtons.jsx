import React from "react";
import { Field, ErrorMessage } from "formik";
import TextError from "./TextError";

function RadioButtons(props) {
  const { label, name, options, onChange, ...rest } = props;
  return (
    <div className="form-control">
      <label>{label}</label>
      <Field name={name}>
        {({ form, field }) => {
          const { setFieldValue } = form;
          return options.map((option) => {
            return (
              <React.Fragment key={option.text}>
                <input
                  type="radio"
                  id={option.value}
                  {...field}
                  {...rest}
                  value={option.value}
                  checked={field.value === option.value}
                  onChange={(val) => {
                    // console.log("val", val.target.value);
                    setFieldValue(name, val.target.value);
                    if (onChange) onChange(val.target.value);
                  }}
                />
                <label htmlFor={option.value}>{option.text}</label>
              </React.Fragment>
            );
          });
        }}
      </Field>
      <ErrorMessage component={TextError} name={name} />
    </div>
  );
}

export default RadioButtons;
