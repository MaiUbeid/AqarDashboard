import React from "react";

export function TextError(props) {
  return (
    <div className="invalid-field">
      <div className="invalid-feedback">{props.children}</div>
    </div>
  );
}
export default TextError;
