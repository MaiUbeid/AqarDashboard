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
  options6,
  options7,
  options8
} from "./apexLineChartOptions";

class ApexLineChart extends Component {
  state = {};
  render() {
    return (
      <div>
        <Breadcrumb
          routeSegments={[
            { name: "Charts", path: "/charts" },
            { name: "Apex", path: "/apex" },
            { name: "Line Chart" }
          ]}
        />
        <Row>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard
              className="h-100"
              title="Basic line chart(Product Trends by Month)
"
            >
              <Chart
                options={options1}
                series={options1.series}
                type={options1.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard
              className="h-100"
              title="Line with data Label(Average High & Low Temperature)"
            >
              <Chart
                options={options2}
                series={options2.series}
                type={options2.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard
              className="h-100"
              title="Zoomable timeseries chart(Stock Price Movement)      "
            >
              <Chart
                options={options3}
                series={options3.series}
                type={options3.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard
              className="h-100"
              title="Gradient Line Chart(Social Media)"
            >
              <Chart
                options={options4}
                series={options4.series}
                type={options4.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard
              className="h-100"
              title="Real time Line chart(Dynamic Updating Chart)
"
            >
              <Chart
                options={options5}
                series={options5.series}
                type={options5.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard
              className="h-100"
              title="Dashed Line Chart(Page Statistics)"
            >
              <Chart
                options={options6}
                series={options6.series}
                type={options6.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Brush Line chart">
              <Chart
                options={options7}
                series={options7.series}
                type={options7.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Dashed Line Chart">
              <Chart
                options={options8}
                series={options8.series}
                type={options8.chart.type}
              />
            </SimpleCard>
          </Col>
        </Row>
      </div>
    );
  }
}

export default ApexLineChart;
