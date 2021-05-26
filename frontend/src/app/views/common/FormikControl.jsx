import React from "react";
import Input from "./Input";
import InputGroup from "./InputGroup";
import Select from "./Select";
import RadioButtons from "./RadioButtons";
import CheckboxGroup from "./CheckboxGroup";
import Checkbox from "./Checkbox";
import SwitchButton from "./SwitchButton";
import DatePicker from "./DatePicker";
import Submitbutton from "./SubmitButton";
import FileUpload from "./FileUpload";
export default function FormikControl({ control, ...rest }) {
  switch (control) {
    case "input":
      return <Input {...rest}></Input>;
    case "InputGroup":
      return <InputGroup {...rest}></InputGroup>;
    case "select":
      return <Select {...rest}></Select>;
    case "checkbox":
      return <Checkbox {...rest} />;
    case "switchButton":
      return <SwitchButton {...rest} />;
    case "submitButton":
      return <Submitbutton {...rest} />;
    case "date":
      return <DatePicker {...rest} />;
    case "radio":
      return <RadioButtons {...rest} />;
    case "checkboxGroup":
      return <CheckboxGroup {...rest} />;
      case "file":
      return <FileUpload {...rest} />;
    default:
      return null;
  }
}
