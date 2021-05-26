import React, { Component } from "react";

class Select extends Component {
  render() {
    let { name, text, label, options, error, width, ...rest } = this.props;
    if (!width) width = 12;
    return (
      <div className={`col-md-${width} form-group mb-3`}>
        {label && <label htmlFor={name}>{label}</label>}
        <select id={name} name={name} {...rest} className="form-control">
          <option value="">اختر عنصر</option>
          {options.map((option) => (
            <option key={option.value} value={option.value}>
              {option.text}
            </option>
          ))}
        </select>
        {error && <div className="alert alert-danger">{error}</div>}
      </div>
    );
  }
}

export default Select;
