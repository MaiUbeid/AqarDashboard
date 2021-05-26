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
} from "./apexDoughnutChartOptions";

class ApexDoughnutChart extends Component {
  state = {};
  render() {
    return (
      <div>
        <Breadcrumb
          routeSegments={[
            { name: "Charts", path: "/charts" },
            { name: "Apex", path: "/apex" },
            { name: "Doughnut Chart" }
          ]}
        />
        <Row>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Simple Pie">
              <Chart
                options={options1}
                series={options1.series}
                type={options1.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Simple Donut">
              <Chart
                options={options2}
                series={options2.series}
                type={options2.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard
              className="h-100"
              title="Monochrome Pie(Number of leads)"
            >
              <Chart
                options={options3}
                series={options3.series}
                type={options3.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Gradient Donut">
              <Chart
                options={options4}
                series={options4.series}
                type={options4.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard
              className="h-100"
              title="Donut with Pattern(Favourite Movie Type)"
            >
              <Chart
                options={options5}
                series={options5.series}
                type={options5.chart.type}
              />
            </SimpleCard>
          </Col>
          <Col lg={4} md={4} sm={6} xs={12} className="mb-4">
            <SimpleCard className="h-100" title="Pie with Image">
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

export default ApexDoughnutChart;
