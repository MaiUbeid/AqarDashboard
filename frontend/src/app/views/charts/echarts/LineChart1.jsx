import React from "react";
import ReactEcharts from "echarts-for-react";
import { echartOptions } from "@gull";
const LineChart1 = ({ height }) => {
  const option = {
    ...echartOptions.lineNoAxis,
    series: [
      {
        data: [30, 40, 20, 50, 40, 80, 90],
        ...echartOptions.smoothLine,
        markArea: {
          label: {
            show: true
          }
        },
        areaStyle: {
          color: "rgba(102, 51, 153, .2)",
          origin: "start"
        },
        lineStyle: {
          color: "#663399"
        },
        itemStyle: {
          color: "#663399"
        }
      }
    ]
  };

  return <ReactEcharts style={{ height: height }} option={option} />;
};

export default LineChart1;
