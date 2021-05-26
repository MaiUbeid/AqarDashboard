import React, { Component } from "react";
import { Breadcrumb, SimpleCard } from "@gull";
import VisLineChart from "./VisLineChart";
import ColoredLineChart from "./ColoredLineChart";
import VisAreaChart from "./VisAreaChart";
import VisBarChart from "./VisBarChart";
import BigBaseBarSeries from "./BigBaseBarSeries";
import LabeledHeatmap from "./LabelledHeatMap";
import ContourSeriesChart from "./ContourSeries";

class AppReactVis extends Component {
  state = {};
  render() {
    return (
      <div>
        <Breadcrumb
          routeSegments={[
            { name: "Charts", path: "/charts" },
            { name: "React Vis Charts" }
          ]}
        />
        <SimpleCard title="heatmap with label">
          <LabeledHeatmap />
        </SimpleCard>
        <div className="py-2" />
        <SimpleCard title="line chart with many color">
          <ColoredLineChart />
        </SimpleCard>
        <div className="py-2" />
        <SimpleCard title="big base bar series">
          <BigBaseBarSeries />
        </SimpleCard>
        <div className="py-2" />
        <SimpleCard title="contour map">
          <ContourSeriesChart />
        </SimpleCard>
        <div className="py-2" />
        <SimpleCard title="line chart">
          <VisLineChart />
        </SimpleCard>
        <div className="py-2" />
        <SimpleCard title="area Chart">
          <VisAreaChart />
        </SimpleCard>
        <div className="py-2" />
        <SimpleCard title="bar Chart">
          <VisBarChart />
        </SimpleCard>
      </div>
    );
  }
}

export default AppReactVis;
