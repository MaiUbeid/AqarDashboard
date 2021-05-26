import React, { Component } from "react";

import {
  FlexibleWidthXYPlot,
  XAxis,
  YAxis,
  // HorizontalGridLines,
  // VerticalGridLines,
  LineSeries
} from "react-vis";

class ColoredLineChart extends Component {
  state = {
    data: []
  };

  loadData = () => {
    let temp = [];
    for (let i = 0; i < 20; i++) {
      const series = [];
      for (let j = 0; j < 100; j++) {
        series.push({
          x: j,
          y: (i / 10 + 1) * Math.sin((Math.PI * (i + j)) / 50)
        });
      }
      temp.push({ color: i, key: i, data: series, opacity: 0.9 });
    }

    this.setState({
      data: [...temp]
    });
  };

  componentDidMount() {
    this.loadData();
  }

  render() {
    let { data } = this.state;
    return (
      <FlexibleWidthXYPlot
        height={320}
        colorType="linear"
        colorDomain={[0, 9]}
        colorRange={["yellow", "orange"]}
      >
        <XAxis
        // style={{
        //   text: {
        //     stroke: "none",
        //     fontWeight: 600
        //   }
        // }}
        />
        <YAxis
        // style={{
        //   text: {
        //     stroke: "none",
        //     fontWeight: 600
        //   }
        // }}
        />
        {data.map(props => (
          <LineSeries {...props} />
        ))}
      </FlexibleWidthXYPlot>
    );
  }
}

export default ColoredLineChart;
