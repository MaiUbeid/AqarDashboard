import React from "react";
import _ from "lodash";

const TableBody = (props) => {
  let { data, columns, serialSeedNumber } = props;
  if (!serialSeedNumber) serialSeedNumber = 0;
  const renderCell = (obj, column) => {
    if (column.content) return column.content(obj);
    return _.get(obj, column.path);
  };
  return (
    <tbody>
      {data.map((obj, index) => (
        <tr key={index}>
          {columns.map((column) => (
            <td key={column.path || column.key}>{column.isSerial ? serialSeedNumber + index + 1 : renderCell(obj, column)}</td>
          ))}
        </tr>
      ))}
    </tbody>
  );
};

export default TableBody;
