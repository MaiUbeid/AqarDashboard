import React from "react";
import ReactEcharts from "echarts-for-react";

const PieChart = ({ height, color = [] }) => {
  const option = {
    color: ["#62549c", "#7566b5", "#7d6cbb", "#8877bd", "#9181bd", "#6957af"],
    tooltip: {
      show: true,
      backgroundColor: "rgba(0, 0, 0, .8)"
    },

    series: [
      {
        name: "Sales by Country",
        type: "pie",
        radius: "60%",
        center: ["50%", "50%"],
        data: [
          { value: 535, name: "USA" },
          { value: 310, name: "Brazil" },
          { value: 234, name: "France" },
          { value: 155, name: "BD" },
          { value: 130, name: "UK" },
          { value: 348, name: "India" }
        ],
        itemStyle: {
          emphasis: {
            shadowBlur: 10,
            shadowOffsetX: 0,
            shadowColor: "rgba(0, 0, 0, 0.5)"
          }
        }
      }
    ]
  };

  return <ReactEcharts style={{ height: height }} option={option} />;
};

export default PieChart;
