import React from "react";
import ReactEcharts from "echarts-for-react";
import { echartOptions } from "@gull";
const LineChart3 = ({ height }) => {
  const option = {
    ...echartOptions.lineSplitNoAxis,
    grid: {
      top: 15,
      left: 15,
      right: 15,
      bottom: 0
    },
    series: [
      {
        data: [
          40,
          80,
          20,
          90,
          30,
          80,
          40,
          90,
          20,
          80,
          30,
          45,
          50,
          110,
          90,
          145,
          120,
          135,
          120,
          140
        ],
        lineStyle: {
          color: "rgba(102, 51, 153, 0.8)",
          width: 3,
          ...echartOptions.lineShadow
        },
        label: { show: true, color: "#212121" },
        type: "line",
        smooth: true,
        itemStyle: {
          borderColor: "rgba(102, 51, 153, 1)"
        }
      }
    ]
  };

  return <ReactEcharts style={{ height: height }} option={option} />;
};

export default LineChart3;
