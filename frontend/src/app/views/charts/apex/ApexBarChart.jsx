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
} from "./apexBarChartOptions";

class ApexBarChart extends Component {
  state = {};
  render() {
    return (
      <div>
        <Breadcrumb
          routeSegments={[
            { name: "Charts", path: "/charts" },
            { name: "Apex", path: "/apex" },
            { name: "Bar Chart" }
          ]}
        />
        <Row>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Basic Bar chart">
              <Chart
                options={options1}
                series={options1.series}
                type={options1.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Grouped Bar">
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
              title="Stacked Bars(Fiction Books Sales)"
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
              title="Bar with Negative Values(Mauritius population pyramid 2011)"
            >
              <Chart
                options={options4}
                series={options4.series}
                type={options4.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Custom DataLabels Bar">
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
              title="Patterned Bar(Compare Sales Strategy)"
            >
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

export default ApexBarChart;
