import React from "react";
import ReactEcharts from "echarts-for-react";
import { echartOptions } from "@gull";
const LineChart2 = ({ height }) => {
  const option = {
    ...echartOptions.lineNoAxis,
    series: [
      {
        data: [30, 10, 40, 10, 40, 20, 90],
        ...echartOptions.smoothLine,
        markArea: {
          label: {
            show: true
          }
        },
        areaStyle: {
          color: "rgba(255, 193, 7, 0.2)",
          origin: "start"
        },
        lineStyle: {
          color: "#FFC107"
        },
        itemStyle: {
          color: "#FFC107"
        }
      }
    ]
  };

  return <ReactEcharts style={{ height: height }} option={option} />;
};

export default LineChart2;
