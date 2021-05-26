import React from "react";

export default function Submitbutton({ initialLabel, loadingLabel, isSpinnerDisplayed = false,...rest }) {
  return (
    <button type="submit" className="btn btn-primary col-12" disabled={isSpinnerDisplayed ? "disabled" : ""} {...rest}>
      {!isSpinnerDisplayed && initialLabel}
      {isSpinnerDisplayed && (
        <React.Fragment>
          <span> {loadingLabel}....</span>
          <span className="spinner-glow spinner-glow-light ml-2" style={{ verticalAlign: "middle" }}></span>
        </React.Fragment>
      )}
    </button>
  );
}
