import React from "react";
import ReactEcharts from "echarts-for-react";
import { echartOptions } from "@gull";

const DoughnutChart = ({ height }) => {
  const option = {
    ...echartOptions.defaultOptions,
    legend: {
      show: true,
      bottom: 0
    },
    series: [
      {
        type: "pie",
        ...echartOptions.pieRing,

        label: echartOptions.pieLabelCenterHover,
        data: [
          {
            name: "Completed",
            value: 80,
            itemStyle: {
              color: "#663399"
            }
          },
          {
            name: "Pending",
            value: 20,
            itemStyle: {
              color: "#ced4da"
            }
          }
        ]
      }
    ]
  };

  return <ReactEcharts style={{ height: height }} option={option} />;
};

export default DoughnutChart;
