import React, { Component } from "react";
import { Breadcrumb, SimpleCard } from "@gull";
import { Row, Col } from "react-bootstrap";
import Chart from "react-apexcharts";
import {
  options1,
  options2,
  options3,
  options4,
  options5,
  options6
} from "./apexRadialBarChartOptions";

class ApexRadialBarChart extends Component {
  state = {};
  render() {
    return (
      <div>
        <Breadcrumb
          routeSegments={[
            { name: "Charts", path: "/charts" },
            { name: "Apex", path: "/apex" },
            { name: "Radial Bar Chart" }
          ]}
        />
        <Row>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Simple Radial Bar">
              <Chart
                options={options1}
                series={options1.series}
                type={options1.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Multiple Radial Bar">
              <Chart
                options={options2}
                series={options2.series}
                type={options2.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Custom Angle Circle Chart">
              <Chart
                options={options3}
                series={options3.series}
                type={options3.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Gradient Radial Bar">
              <Chart
                options={options4}
                series={options4.series}
                type={options4.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Radialbars with Image">
              <Chart
                options={options5}
                series={options5.series}
                type={options5.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Stroked Angular Gauge">
              <Chart
                options={options6}
                series={options6.series}
                type={options6.chart.type}
              />
            </SimpleCard>
          </Col>
        </Row>
      </div>
    );
  }
}

export default ApexRadialBarChart;
