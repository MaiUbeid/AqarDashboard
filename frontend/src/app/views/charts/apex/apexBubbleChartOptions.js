function generateData1(baseval, count, yrange) {
  var i = 0;
  var Simpleseries = [];
  while (i < count) {
    var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;
    var y =
      Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
    var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

    Simpleseries.push([x, y, z]);
    baseval += 86400000;
    i++;
  }
  return Simpleseries;
}

export const options1 = {
  chart: {
    height: 350,
    type: "bubble",
    toolbar: {
      show: false
    }
  },
  dataLabels: {
    enabled: false
  },
  series: [
    {
      name: "Bubble1",
      data: generateData1(new Date("11 Feb 2017 GMT").getTime(), 20, {
        min: 10,
        max: 60
      })
    },
    {
      name: "Bubble2",
      data: generateData1(new Date("11 Feb 2017 GMT").getTime(), 20, {
        min: 10,
        max: 60
      })
    },
    {
      name: "Bubble3",
      data: generateData1(new Date("11 Feb 2017 GMT").getTime(), 20, {
        min: 10,
        max: 60
      })
    },
    {
      name: "Bubble4",
      data: generateData1(new Date("11 Feb 2017 GMT").getTime(), 20, {
        min: 10,
        max: 60
      })
    }
  ],
  fill: {
    opacity: 0.8
  },

  xaxis: {
    tickAmount: 12,
    type: "category"
  },
  yaxis: {
    max: 70
  }
};

function generateData(baseval, count, yrange) {
  var i = 0;
  var dseries = [];
  while (i < count) {
    var y =
      Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
    var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

    dseries.push([baseval, y, z]);
    baseval += 86400000;
    i++;
  }
  return dseries;
}

export const options2 = {
  chart: {
    height: 350,
    type: "bubble"
  },
  dataLabels: {
    enabled: false
  },
  series: [
    {
      name: "Product1",
      data: generateData(new Date("11 Feb 2017 GMT").getTime(), 20, {
        min: 10,
        max: 60
      })
    },
    {
      name: "Product2",
      data: generateData(new Date("11 Feb 2017 GMT").getTime(), 20, {
        min: 10,
        max: 60
      })
    },
    {
      name: "Product3",
      data: generateData(new Date("11 Feb 2017 GMT").getTime(), 20, {
        min: 10,
        max: 60
      })
    },
    {
      name: "Product4",
      data: generateData(new Date("11 Feb 2017 GMT").getTime(), 20, {
        min: 10,
        max: 60
      })
    }
  ],
  fill: {
    type: "gradient"
  },

  xaxis: {
    tickAmount: 12,
    type: "datetime",

    labels: {
      rotate: 0
    }
  },
  yaxis: {
    max: 70
  },
  theme: {
    palette: "palette2"
  }
};
