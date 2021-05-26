import React, { useState, useEffect } from "react";
import ReactEcharts from "echarts-for-react";
import { getDashYear } from './../../../services/fundSettingsServcie';

const ComparisonChart = ({ height, color = [], requestsArray = [], offersArray = [] }) => {
  // const [offers, setOffers] = useState([]);
  // const [requests, setRequests] = useState([]);
  const option = {
    legend: {
      borderRadius: 0,
      orient: "horizontal",
      x: "right",
      data: ["العروض المرسلة", "الطلبات"]
    },
    grid: {
      left: "8px",
      right: "8px",
      bottom: "0",
      containLabel: true
    },
    tooltip: {
      show: true,
      backgroundColor: "rgba(0, 0, 0, .8)"
    },
    xAxis: [
      {
        type: "category",
        data: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sept",
          "Oct",
          "Nov",
          "Dec"
        ],
        axisTick: {
          alignWithLabel: true
        },
        splitLine: {
          show: false
        },
        axisLine: {
          show: true
        }
      }
    ],
    yAxis: [
      {
        type: "value",
        axisLabel: {
          formatter: "{value}"
        },
        min: 0,
        // max: 100000,
        // interval: 25000,
        axisLine: {
          show: false
        },
        splitLine: {
          show: true,
          interval: "auto"
        }
      }
    ],

    series: [
      {
        name: "العروض المرسلة",
        data: offersArray,
        label: { show: false, color: "#0168c1" },
        type: "bar",
        barGap: 0,
        color: "#bcbbdd",
        smooth: true,
        itemStyle: {
          emphasis: {
            shadowBlur: 10,
            shadowOffsetX: 0,
            shadowOffsetY: -2,
            shadowColor: "rgba(0, 0, 0, 0.3)"
          }
        }
      },
      {
        name: "الطلبات",
        data: requestsArray,
        label: { show: false, color: "#639" },
        type: "bar",
        color: "#7569b3",
        smooth: true,
        itemStyle: {
          emphasis: {
            shadowBlur: 10,
            shadowOffsetX: 0,
            shadowOffsetY: -2,
            shadowColor: "rgba(0, 0, 0, 0.3)"
          }
        }
      }
    ]
  };

  // useEffect(() => {
  //   const loadData = async () => {
  //     const res = await getData();
  //     const data = res.chartData;
  //     // push data to array
  //     let offersList = [];
  //     offersList.push(data['January'].offers);
  //     offersList.push(data['February'].offers);
  //     offersList.push(data['March'].offers);
  //     offersList.push(data['April'].offers);
  //     offersList.push(data['May'].offers);
  //     offersList.push(data['June'].offers);
  //     offersList.push(data['July'].offers);
  //     offersList.push(data['August'].offers);
  //     offersList.push(data['September'].offers);
  //     offersList.push(data['October'].offers);
  //     offersList.push(data['November'].offers);
  //     offersList.push(data['December'].offers);
  //     // set array to option
  //     setOffers(offersList);
  //     console.log(offersList);
  //   };
  //   loadData();
  // }, []);

  // const getData = async () => {
  //   var response = await getDashYear('2021');
  //   var chartData = response.data.data;
  //   return { chartData };
  // };

  return <ReactEcharts style={{ height: height }} option={option} />;
};

export default ComparisonChart;
