import { lazy } from "react";

const AppEchart = lazy(() => import("./echarts/AppEchart"));

const AppRechart = lazy(() => import("./recharts/AppRechart"));

const AppVictoryChart = lazy(() => import("./victory-charts/AppVictoryChart"));

const AppReactVis = lazy(() => import("./react-vis/AppReactVis"));

const ApexAreaChart = lazy(() => import("./apex/ApexAreaChart"));

const ApexBarChart = lazy(() => import("./apex/ApexBarChart"));

const ApexLineChart = lazy(() => import("./apex/ApexLineChart"));

const ApexBubbleChart = lazy(() => import("./apex/ApexBubbleChart"));

const ApexMixChart = lazy(() => import("./apex/ApexMixChart"));

const ApexDoughnutChart = lazy(() => import("./apex/ApexDoughnutChart"));

const ApexRadialBarChart = lazy(() => import("./apex/ApexRadialBarChart"));

const ApexScatterChart = lazy(() => import("./apex/ApexScatterChart"));

const ApexSparkLineChart = lazy(() => import("./apex/ApexSparkLineChart"));

const ApexRadarChart = lazy(() => import("./apex/ApexRadarChart"));

const ApexColumnChart = lazy(() => import("./apex/ApexColumnChart"));

const chartsRoute = [
  {
    path: "/charts/echart",
    component: AppEchart
  },
  {
    path: "/charts/recharts",
    component: AppRechart
  },
  {
    path: "/charts/victory-chart",
    component: AppVictoryChart
  },
  {
    path: "/charts/react-vis",
    component: AppReactVis
  },
  {
    path: "/charts/apex-chart/area",
    component: ApexAreaChart
  },
  {
    path: "/charts/apex-chart/bar",
    component: ApexBarChart
  },
  {
    path: "/charts/apex-chart/bubble",
    component: ApexBubbleChart
  },
  {
    path: "/charts/apex-chart/mix",
    component: ApexMixChart
  },
  {
    path: "/charts/apex-chart/doughnut",
    component: ApexDoughnutChart
  },
  {
    path: "/charts/apex-chart/radial-bar",
    component: ApexRadialBarChart
  },
  {
    path: "/charts/apex-chart/scatter",
    component: ApexScatterChart
  },
  {
    path: "/charts/apex-chart/spark-line",
    component: ApexSparkLineChart
  },
  {
    path: "/charts/apex-chart/radar",
    component: ApexRadarChart
  },
  {
    path: "/charts/apex-chart/column",
    component: ApexColumnChart
  },
  {
    path: "/charts/apex-chart/line",
    component: ApexLineChart
  }
];

export default chartsRoute;
