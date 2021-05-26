import React from "react";
import {
  Card,
  Accordion,
  AccordionToggle,
  AccordionCollapse,
  Button
} from "react-bootstrap";
import { classList } from "@utils";
import PropTypes from "prop-types";

const RightArrowAccordion = ({ title, children, icon, eventKey }) => {
  const [openItem, setOpenItem] = React.useState(false);

  return (
    <Card className="ul-card__border-radius">
      <Card.Header className="d-flex align-items-center justify-content-between">
        <AccordionToggle
          as="span"
          eventKey={eventKey}
          onClick={() => setOpenItem(!openItem)}
          className="cursor-pointer"
        >
          <div className="card-title mb-0 text-primary">
            {icon && <i className={`${icon} mr-2 text-15`}></i>}
            {title}
          </div>
        </AccordionToggle>
        <AccordionToggle
          as="span"
          eventKey={eventKey}
          onClick={() => setOpenItem(!openItem)}
          className="cursor-pointer"
        >
          <i
            className={classList({
              "text-primary text-16": true,
              "i-Arrow-Down": !openItem,
              "i-Arrow-Up": openItem
            })}
          ></i>
        </AccordionToggle>
      </Card.Header>
      <AccordionCollapse eventKey={eventKey}>
        <Card.Body>{children}</Card.Body>
      </AccordionCollapse>
    </Card>
  );
};

RightArrowAccordion.propTypes = {
  eventKey: PropTypes.string.isRequired
};

export default RightArrowAccordion;
