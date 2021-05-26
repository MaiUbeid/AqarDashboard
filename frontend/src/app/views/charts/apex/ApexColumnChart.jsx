import React, { Component } from "react";
import { Breadcrumb, SimpleCard } from "@gull";
import { Row, Col } from "react-bootstrap";
import Chart from "react-apexcharts";
import {
  options1,
  options2,
  options3,
  options4,
  options5
} from "./apexColumnChartOptions";

class ApexColumnChart extends Component {
  state = {};
  render() {
    return (
      <div>
        <Breadcrumb
          routeSegments={[
            { name: "Charts", path: "/charts" },
            { name: "Apex", path: "/apex" },
            { name: "Column Chart" }
          ]}
        />
        <Row>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Basic Column chart">
              <Chart
                options={options1}
                series={options1.series}
                type={options1.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Column with Data Labels">
              <Chart
                options={options2}
                series={options2.series}
                type={options2.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Stacked Columns">
              <Chart
                options={options3}
                series={options3.series}
                type={options3.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Column with Negative Values">
              <Chart
                options={options4}
                series={options4.series}
                type={options4.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Distributed Columns">
              <Chart
                options={options5}
                series={options5.series}
                type={options5.chart.type}
              />
            </SimpleCard>
          </Col>
        </Row>
      </div>
    );
  }
}

export default ApexColumnChart;
