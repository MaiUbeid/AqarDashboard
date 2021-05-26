import React from "react";

const TableHeader = (props) => {

  const raiseSort = (path) => {
    if (!path) {
      //console.log("No sort event attached");
      return;
    } //Incase of edit or delete- for ex-  the path is undefined.

    let sortColumn = { ...props.sortColumn };
    if (sortColumn.path === path) sortColumn.order = sortColumn.order === "asc" ? "desc" : "asc";
    else {
      sortColumn.path = path;
      sortColumn.order = "asc";
    }
    props.onSort(sortColumn);
  };

  const setSortIcon = (column) => {
    const { sortColumn } = props;
    if (sortColumn.path !== column.path) return;
    if (sortColumn.order === "asc") return <i className="text-12 i-Up1"></i>;
    return <i className="text-12 i-Down1"></i>;
  };

  return (
    <thead>
      <tr className="cursor-pointer mr-3">
        {props.columns.map((column) =>
          column.isSerial ? (
            <th scop="col" key="Serial column key">
              {column.label}
            </th>
          ) : (
            <th scope="col" key={column.key || column.path} onClick={() => raiseSort(column.path)} className="sortable">
              {setSortIcon(column)}
              {column.label}
            </th>
          )
        )}
      </tr>
    </thead>
  );
};

export default TableHeader;