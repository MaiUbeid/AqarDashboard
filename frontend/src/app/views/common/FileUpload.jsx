import React, { useState, useEffect } from "react";
import { Field, ErrorMessage } from "formik";
import TextError from "./TextError";

export default function FileUpload(props) {
  const { name, onFileChange, setFieldValue, ...rest } = props;
  let { label, width, multiple } = props;
  if (!width) width = "6";
  if (!label) label = "اختر ملف";
  if (!multiple) multiple = false;
  else multiple = multiple;

  const [imageurl, setImageUrl] = useState(props.imageUrl ? props.imageUrl : "/assets/images/placeholder.png");
  const [isSpinning, setSpinner] = useState(true);

  useEffect(() => {
    if (props.imageUrl) {
      setImageUrl(props.imageUrl);
    }
    setSpinner(false);
  }, [props.imageurl]);

  const handleFile = (event) => {
    const reader = new FileReader();
    reader.onload = () => {
      if (reader.readyState === 2) {
        setImageUrl(reader.result);
        setSpinner(false);
      }
    }
    reader.readAsDataURL(event.target.files[0]);
  }

  return (
    <div className="item-card-image">
      <img className="card-img" src={imageurl}
        alt={label} />
      <div className="card-img-overlay">
        <div className="upload-image">
          <input
            type="file"
            className="custom-file-input"
            id={name}
            name={name}
            {...rest}
            onChange={(event) => {
              setSpinner(true);
              setFieldValue({ name }, multiple ? event.target.files : event.target.files[0]);
              onFileChange(event);
              handleFile(event);
            }}
          />
          <label htmlFor={name} className="custom-file-label">
            <i className="i-Edit mr-2"></i> {label === "oldFileUploaded" ? "تعديل الملف" : label}
          </label>
          {isSpinning && (<div className="spinner spinner-primary mr-3 update-image-spinner"></div>)}
          <ErrorMessage name={name} component={TextError} />
        </div>
      </div>
    </div>
  );
}
