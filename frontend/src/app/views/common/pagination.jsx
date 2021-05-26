import React from "react";
import PropTypes from "prop-types";
import ReactPaginate from "react-paginate";

//props object destructuring
const Pagination = ({ itemsCount, rowsPerPage, onPageChange }) => {
  if (itemsCount <= rowsPerPage) return <></>;
  return (
    <ReactPaginate
      previousLabel="السابق"
      nextLabel="التالي"
      breakLabel="..."
      breakClassName={"break-me"}
      pageCount={Math.ceil(itemsCount / rowsPerPage)}
      marginPagesDisplayed={2}
      pageRangeDisplayed={3}
      onPageChange={onPageChange}
      containerClassName={"pagination pagination-lg"}
      subContainerClassName={"pages pagination"}
      activeClassName={"active"}
    />
  );
};
Pagination.propTypes = {
  itemsCount: PropTypes.number.isRequired,
  rowsPerPage: PropTypes.number.isRequired,
  //currentPage: PropTypes.number.isRequired,
  onPageChange: PropTypes.func.isRequired,
};
export default Pagination;
