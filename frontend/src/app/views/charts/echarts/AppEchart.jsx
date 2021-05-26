import React from "react";
import { Breadcrumb, SimpleCard } from "@gull";
import ReactEcharts from "echarts-for-react";
import {
  echartBarOption,
  echartPieOption,
  echartBasicLineOption,
  echartMultilineOption,
  echartBasicBarOption,
  echartMultipleBarOption,
  echartMultipleBar2Option,
  echartZoomBarOption,
  echartBasicDoughnutOption,
  echartBasicAreaOption,
  echartStackedAreaOption,
  echartStackedPieOption,
  echartSolidAreaOption,
  echartBasicPie,
  echartBubbleOption
} from "./echartOptions";
import { Row, Col } from "react-bootstrap";

const AppEchart = ({ theme }) => {
  return (
    <div className="m-sm-30">
      <Breadcrumb
        routeSegments={[
          { name: "Charts", path: "/charts" },
          { name: "Echarts" }
        ]}
      />
      <Row>
        <Col lg={8} md={8} sm={12} xs={12} className="mb-4">
          <SimpleCard title="This Year Sales">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartBarOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={4} md={4} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Sales by Countries">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartPieOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Basic Line">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartBasicLineOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Multi Line">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartMultilineOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Basic Bar chart">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartBasicBarOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Multiple Bar chart">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartMultipleBarOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Multiple Bar chart 2">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartMultipleBar2Option}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Zoom Bar">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartZoomBarOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Basic Doughnut">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartBasicDoughnutOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Basic Area Chart">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartBasicAreaOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Stacked Area Chart">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartStackedAreaOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Stacked Area Chart with Pointer">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartStackedPieOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Solid Area">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartSolidAreaOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Basic Pie Chart">
            <ReactEcharts style={{ height: "280px" }} option={echartBasicPie} />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Stacked Pie Chart">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartStackedPieOption}
            />
          </SimpleCard>
        </Col>
        <Col lg={6} md={6} sm={12} xs={12} className="mb-4">
          <SimpleCard title="Bubble Chart">
            <ReactEcharts
              style={{ height: "280px" }}
              option={echartBubbleOption}
            />
          </SimpleCard>
        </Col>
      </Row>
    </div>
  );
};

export default AppEchart;
