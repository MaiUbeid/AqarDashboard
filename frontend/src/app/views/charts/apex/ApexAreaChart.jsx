import React, { Component } from "react";
import { Breadcrumb, SimpleCard } from "@gull";
import { Row, Col } from "react-bootstrap";
import Chart from "react-apexcharts";
import {
  bAOptions1,
  bAOptions2,
  bAOptions3,
  bAOptions4,
  bAOptions5,
  bAOptions6
} from "./apexAreaChartOptions";

class ApexAreaChart extends Component {
  state = {};
  render() {
    // console.log(bAOptions1);

    return (
      <div>
        <Breadcrumb
          routeSegments={[
            { name: "Charts", path: "/charts" },
            { name: "Apex", path: "/apex" },
            { name: "Area Chart" }
          ]}
        />
        <Row>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard
              className="h-100"
              title="Basic Area chart(Fundamental Analysis of Stocks)"
            >
              <Chart
                options={bAOptions1}
                series={bAOptions1.series}
                type={bAOptions1.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Spline Area">
              <Chart
                options={bAOptions2}
                series={bAOptions2.series}
                type={bAOptions2.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Datetime X-axis">
              <Chart
                options={bAOptions3}
                series={bAOptions3.series}
                type={bAOptions3.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Area with Negative Values">
              <Chart
                options={bAOptions4}
                series={bAOptions4.series}
                type={bAOptions4.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Stacked Area Chart">
              <Chart
                options={bAOptions5}
                series={bAOptions5.series}
                type={bAOptions5.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard
              className="h-100"
              title="Missing / Null values Area Chart(Network Monitoring)"
            >
              <Chart
                options={bAOptions6}
                series={bAOptions6.series}
                type={bAOptions6.chart.type}
              />
            </SimpleCard>
          </Col>
        </Row>
      </div>
    );
  }
}

export default ApexAreaChart;
